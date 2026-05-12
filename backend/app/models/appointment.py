from sqlalchemy import Column, Integer, String, DateTime, Text, Enum
from sqlalchemy.sql import func
from ..database import Base


class Appointment(Base):
    __tablename__ = "appointments"

    id_appointment = Column(Integer, primary_key=True, autoincrement=True)
    idlogin = Column(Integer, nullable=True)
    name_surName = Column(String(100), nullable=False)
    email = Column(String(100), nullable=False, index=True)
    telephone = Column(String(20), nullable=False)
    date_appointment = Column(DateTime, nullable=False, index=True)
    raison = Column(Text, nullable=True)
    service = Column(String(191), nullable=True, index=True)
    status = Column(
        Enum("pending", "confirmed", "cancelled", "completed"),
        default="pending",
        index=True,
    )
    confirmation_token = Column(String(64), nullable=True)
    confirmed_at = Column(DateTime, nullable=True)
    cancelled_at = Column(DateTime, nullable=True)
    date_creation = Column(DateTime, server_default=func.now())
    date_modification = Column(DateTime, nullable=True, onupdate=func.now())
