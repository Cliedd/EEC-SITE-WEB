from datetime import datetime
from typing import Optional
from pydantic import BaseModel, EmailStr, field_validator


class ContactCreate(BaseModel):
    name_surName: str
    email: EmailStr
    telephone: Optional[str] = None
    objet: str
    message: str

    @field_validator("name_surName")
    @classmethod
    def name_valid(cls, v: str) -> str:
        v = v.strip()
        if len(v) < 3:
            raise ValueError("Le nom doit contenir au moins 3 caractères")
        if len(v) > 150:
            raise ValueError("Le nom est trop long")
        return v

    @field_validator("objet")
    @classmethod
    def objet_valid(cls, v: str) -> str:
        v = v.strip()
        if len(v) < 2:
            raise ValueError("L'objet est trop court")
        if len(v) > 200:
            raise ValueError("L'objet est trop long (max 200 caractères)")
        return v

    @field_validator("message")
    @classmethod
    def message_valid(cls, v: str) -> str:
        v = v.strip()
        if len(v) < 10:
            raise ValueError("Le message doit contenir au moins 10 caractères")
        if len(v) > 5000:
            raise ValueError("Le message est trop long (max 5000 caractères)")
        return v


class ContactOut(BaseModel):
    id_contact: int
    name_surName: str
    email: str
    telephone: Optional[str]
    objet: str
    message: str
    status: str
    date_creation: datetime

    model_config = {"from_attributes": True}
