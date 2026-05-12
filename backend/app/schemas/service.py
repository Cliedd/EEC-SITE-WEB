from datetime import datetime
from typing import Optional
from pydantic import BaseModel


class ServiceOut(BaseModel):
    id: int
    name: str
    description: Optional[str]
    specialite: Optional[str]
    icon: Optional[str]
    is_active: int
    ordre_affichage: int

    model_config = {"from_attributes": True}


class ServiceCreate(BaseModel):
    name: str
    description: Optional[str] = None
    specialite: Optional[str] = None
    icon: Optional[str] = None
    is_active: int = 1
    ordre_affichage: int = 0


class ServiceUpdate(BaseModel):
    name: Optional[str] = None
    description: Optional[str] = None
    is_active: Optional[int] = None
    ordre_affichage: Optional[int] = None
