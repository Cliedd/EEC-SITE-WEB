from sqlalchemy import Column, Integer, String, DateTime, Text, SmallInteger
from sqlalchemy.sql import func
from ..database import Base


class Service(Base):
    __tablename__ = "services"

    id = Column(Integer, primary_key=True, autoincrement=True)
    name = Column(String(191), nullable=False, unique=True)
    description = Column(Text, nullable=True)
    specialite = Column(String(100), nullable=True)
    icon = Column(String(100), nullable=True)
    is_active = Column(SmallInteger, default=1, index=True)
    ordre_affichage = Column(Integer, default=0)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, nullable=True, onupdate=func.now())
