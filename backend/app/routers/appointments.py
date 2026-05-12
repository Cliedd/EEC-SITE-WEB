import math
from fastapi import APIRouter, Depends, HTTPException, Request, status, BackgroundTasks
from sqlalchemy.orm import Session

from ..database import get_db
from ..models.appointment import Appointment
from ..models.visitor import Visitor
from ..schemas.appointment import (
    AppointmentCreate,
    AppointmentOut,
    AppointmentListOut,
    AppointmentStatusUpdate,
)
from ..utils.audit import log_action
from ..utils.email import send_appointment_confirmation
from .deps import get_current_admin

router = APIRouter(prefix="/appointments", tags=["appointments"])


@router.post("", response_model=AppointmentOut, status_code=status.HTTP_201_CREATED)
async def create_appointment(
    payload: AppointmentCreate,
    request: Request,
    background_tasks: BackgroundTasks,
    db: Session = Depends(get_db),
):
    appt = Appointment(
        name_surName=payload.name_surName,
        email=payload.email,
        telephone=payload.telephone,
        date_appointment=payload.date_appointment,
        service=payload.service,
        raison=payload.raison,
        status="pending",
    )
    db.add(appt)

    visitor = Visitor(
        name_surName=payload.name_surName,
        email=payload.email,
        telephone=payload.telephone,
        visitor_type="appointment_request",
        source_page="/appointment",
        ip_address=request.client.host if request.client else None,
        user_agent=request.headers.get("user-agent"),
    )
    db.add(visitor)
    db.commit()
    db.refresh(appt)

    log_action(
        db,
        action="APPOINTMENT_CREATE",
        entity_type="appointments",
        entity_id=appt.id_appointment,
        user_email=payload.email,
        ip_address=request.client.host if request.client else None,
    )

    date_str = payload.date_appointment.strftime("%d/%m/%Y à %H:%M")
    background_tasks.add_task(
        send_appointment_confirmation,
        payload.email,
        payload.name_surName,
        date_str,
        payload.service,
    )
    return appt


VALID_STATUSES = {"pending", "confirmed", "cancelled", "completed"}


@router.get("", response_model=AppointmentListOut)
def list_appointments(
    page: int = 1,
    per_page: int = 10,
    status_filter: str = None,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    per_page = min(per_page, 100)   # max 100 par page
    page = max(page, 1)
    query = db.query(Appointment)
    if status_filter and status_filter in VALID_STATUSES:
        query = query.filter(Appointment.status == status_filter)
    total = query.count()
    items = (
        query.order_by(Appointment.date_appointment.desc())
        .offset((page - 1) * per_page)
        .limit(per_page)
        .all()
    )
    return AppointmentListOut(
        items=items,
        total=total,
        page=page,
        per_page=per_page,
        total_pages=math.ceil(total / per_page),
    )


@router.get("/{appt_id}", response_model=AppointmentOut)
def get_appointment(
    appt_id: int,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    appt = db.query(Appointment).filter(Appointment.id_appointment == appt_id).first()
    if not appt:
        raise HTTPException(status_code=404, detail="Rendez-vous introuvable")
    return appt


@router.patch("/{appt_id}/status", response_model=AppointmentOut)
def update_status(
    appt_id: int,
    payload: AppointmentStatusUpdate,
    db: Session = Depends(get_db),
    admin=Depends(get_current_admin),
):
    appt = db.query(Appointment).filter(Appointment.id_appointment == appt_id).first()
    if not appt:
        raise HTTPException(status_code=404, detail="Rendez-vous introuvable")
    appt.status = payload.status
    db.commit()
    db.refresh(appt)
    log_action(
        db,
        action="APPOINTMENT_STATUS_UPDATE",
        user_id=admin.id_admin,
        user_email=admin.email,
        entity_type="appointments",
        entity_id=appt_id,
        new_values={"status": payload.status},
    )
    return appt
