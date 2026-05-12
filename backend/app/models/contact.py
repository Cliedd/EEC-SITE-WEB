from sqlalchemy import Column, Integer, String, DateTime, Text, Enum
from sqlalchemy.sql import func
from ..database import Base


class Contact(Base):
    __tablename__ = "contacts"

    id_contact = Column(Integer, primary_key=True, autoincrement=True)
    name_surName = Column(String(100), nullable=False)
    email = Column(String(100), nullable=False, index=True)
    telephone = Column(String(20), nullable=True)
    objet = Column(String(255), nullable=False)
    message = Column(Text, nullable=False)
    status = Column(
        Enum("unread", "read", "replied"),
        default="unread",
        index=True,
    )
    date_creation = Column(DateTime, server_default=func.now())
    date_modification = Column(DateTime, nullable=True, onupdate=func.now())
