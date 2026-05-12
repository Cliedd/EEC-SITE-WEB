import math
from fastapi import APIRouter, Depends, HTTPException, Request, status, BackgroundTasks
from sqlalchemy.orm import Session

from pydantic import BaseModel
from ..database import get_db
from ..models.contact import Contact
from ..models.visitor import Visitor
from ..schemas.contact import ContactCreate, ContactOut
from ..utils.audit import log_action
from ..utils.email import send_contact_ack
from .deps import get_current_admin

router = APIRouter(prefix="/contacts", tags=["contacts"])


@router.post("", response_model=ContactOut, status_code=status.HTTP_201_CREATED)
async def create_contact(
    payload: ContactCreate,
    request: Request,
    background_tasks: BackgroundTasks,
    db: Session = Depends(get_db),
):
    contact = Contact(
        name_surName=payload.name_surName,
        email=payload.email,
        telephone=payload.telephone,
        objet=payload.objet,
        message=payload.message,
        status="unread",
    )
    db.add(contact)

    visitor = Visitor(
        name_surName=payload.name_surName,
        email=payload.email,
        telephone=payload.telephone,
        visitor_type="contact",
        source_page="/contact",
        ip_address=request.client.host if request.client else None,
        user_agent=request.headers.get("user-agent"),
    )
    db.add(visitor)
    db.commit()
    db.refresh(contact)

    log_action(
        db,
        action="CONTACT_CREATE",
        entity_type="contacts",
        entity_id=contact.id_contact,
        user_email=payload.email,
        ip_address=request.client.host if request.client else None,
    )
    background_tasks.add_task(send_contact_ack, payload.email, payload.name_surName)
    return contact


@router.get("", response_model=dict)
def list_contacts(
    page: int = 1,
    per_page: int = 10,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    per_page = min(per_page, 100)
    page = max(page, 1)
    total = db.query(Contact).count()
    items = (
        db.query(Contact)
        .order_by(Contact.date_creation.desc())
        .offset((page - 1) * per_page)
        .limit(per_page)
        .all()
    )
    return {
        "items": [ContactOut.model_validate(c) for c in items],
        "total": total,
        "page": page,
        "per_page": per_page,
        "total_pages": math.ceil(total / per_page),
    }


class ContactStatusUpdate(BaseModel):
    status: str


@router.patch("/{contact_id}/status")
def update_contact_status(
    contact_id: int,
    payload: ContactStatusUpdate,
    db: Session = Depends(get_db),
    _: object = Depends(get_current_admin),
):
    contact = db.query(Contact).filter(Contact.id_contact == contact_id).first()
    if not contact:
        raise HTTPException(status_code=404, detail="Contact introuvable")
    if payload.status not in ("unread", "read", "replied"):
        raise HTTPException(status_code=400, detail="Statut invalide")
    contact.status = payload.status
    db.commit()
    return {"message": "Statut mis à jour"}
