from datetime import datetime, timezone
from typing import Optional, Literal
from pydantic import BaseModel, EmailStr, field_validator
import re


class AppointmentCreate(BaseModel):
    name_surName: str
    email: EmailStr
    telephone: str
    date_appointment: datetime
    service: str
    raison: Optional[str] = None

    @field_validator("name_surName")
    @classmethod
    def name_valid(cls, v: str) -> str:
        v = v.strip()
        if len(v) < 3:
            raise ValueError("Le nom doit contenir au moins 3 caractères")
        if len(v) > 150:
            raise ValueError("Le nom est trop long")
        return v

    @field_validator("telephone")
    @classmethod
    def telephone_valid(cls, v: str) -> str:
        digits = re.sub(r"\D", "", v)
        if len(digits) < 8:
            raise ValueError("Numéro de téléphone invalide")
        if len(v) > 20:
            raise ValueError("Numéro de téléphone trop long")
        return v

    @field_validator("service")
    @classmethod
    def service_valid(cls, v: str) -> str:
        if len(v.strip()) < 2 or len(v) > 100:
            raise ValueError("Service invalide")
        return v.strip()

    @field_validator("raison")
    @classmethod
    def raison_valid(cls, v: Optional[str]) -> Optional[str]:
        if v and len(v) > 1000:
            raise ValueError("La raison est trop longue (max 1000 caractères)")
        return v

    @field_validator("date_appointment")
    @classmethod
    def date_future(cls, v: datetime) -> datetime:
        now = datetime.now(timezone.utc)
        v_aware = v.replace(tzinfo=timezone.utc) if v.tzinfo is None else v
        if v_aware < now:
            raise ValueError("La date du rendez-vous doit être dans le futur")
        return v


class AppointmentOut(BaseModel):
    id_appointment: int
    name_surName: str
    email: str
    telephone: str
    date_appointment: datetime
    service: Optional[str]
    raison: Optional[str]
    status: str
    date_creation: datetime

    model_config = {"from_attributes": True}


class AppointmentStatusUpdate(BaseModel):
    status: Literal["pending", "confirmed", "cancelled", "completed"]


class AppointmentListOut(BaseModel):
    items: list[AppointmentOut]
    total: int
    page: int
    per_page: int
    total_pages: int
