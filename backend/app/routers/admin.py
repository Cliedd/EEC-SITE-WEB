import math
from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session

from ..database import get_db
from ..models.appointment import Appointment
from ..models.contact import Contact
from ..models.visitor import Visitor
from ..models.audit_log import AuditLog
from ..models.user import User
from ..schemas.admin import DashboardStats, VisitorOut, AuditLogOut
from .deps import get_current_admin

router = APIRouter(prefix="/admin", tags=["admin"])


@router.get("/stats", response_model=DashboardStats)
def get_stats(
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    return DashboardStats(
        total_visitors=db.query(Visitor).count(),
        total_appointments=db.query(Appointment).count(),
        pending_appointments=db.query(Appointment)
            .filter(Appointment.status == "pending")
            .count(),
        total_accounts=db.query(User).count(),
        total_contacts=db.query(Contact).count(),
        unread_contacts=db.query(Contact)
            .filter(Contact.status == "unread")
            .count(),
    )


@router.get("/visitors", response_model=dict)
def list_visitors(
    page: int = 1,
    per_page: int = 10,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    per_page = min(per_page, 100)
    page = max(page, 1)
    total = db.query(Visitor).count()
    items = (
        db.query(Visitor)
        .order_by(Visitor.date_visit.desc())
        .offset((page - 1) * per_page)
        .limit(per_page)
        .all()
    )
    return {
        "items": [VisitorOut.model_validate(v) for v in items],
        "total": total,
        "page": page,
        "per_page": per_page,
        "total_pages": math.ceil(total / per_page),
    }


VALID_AUDIT_ACTIONS = {
    "USER_REGISTER", "USER_LOGIN", "ADMIN_LOGIN",
    "APPOINTMENT_CREATE", "APPOINTMENT_STATUS_UPDATE",
    "CONTACT_CREATE",
}


@router.get("/audit-logs", response_model=dict)
def list_audit_logs(
    page: int = 1,
    per_page: int = 20,
    action_filter: str = None,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    per_page = min(per_page, 100)
    page = max(page, 1)
    query = db.query(AuditLog)
    if action_filter and action_filter in VALID_AUDIT_ACTIONS:
        query = query.filter(AuditLog.action == action_filter)
    total = query.count()
    items = (
        query.order_by(AuditLog.timestamp.desc())
        .offset((page - 1) * per_page)
        .limit(per_page)
        .all()
    )
    return {
        "items": [AuditLogOut.model_validate(l) for l in items],
        "total": total,
        "page": page,
        "per_page": per_page,
        "total_pages": math.ceil(total / per_page),
    }


@router.get("/accounts", response_model=dict)
def list_accounts(
    page: int = 1,
    per_page: int = 10,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    per_page = min(per_page, 100)
    page = max(page, 1)
    total = db.query(User).count()
    users = (
        db.query(User)
        .order_by(User.date_creation.desc())
        .offset((page - 1) * per_page)
        .limit(per_page)
        .all()
    )
    return {
        "items": [
            {
                "idlogin": u.idlogin,
                "name_surName": u.name_surName,
                "email": u.email,
                "telephone": u.telephone,
                "actif": u.actif,
                "date_creation": u.date_creation,
            }
            for u in users
        ],
        "total": total,
        "page": page,
        "per_page": per_page,
        "total_pages": math.ceil(total / per_page),
    }
