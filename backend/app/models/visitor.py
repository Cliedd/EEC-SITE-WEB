from sqlalchemy import Column, Integer, String, DateTime, Enum
from sqlalchemy.sql import func
from ..database import Base


class Visitor(Base):
    __tablename__ = "visitors"

    id_visitor = Column(Integer, primary_key=True, autoincrement=True)
    idlogin = Column(Integer, nullable=True)
    name_surName = Column(String(100), nullable=False)
    email = Column(String(100), nullable=False, index=True)
    telephone = Column(String(20), nullable=True)
    visitor_type = Column(
        Enum("new_account", "appointment_request", "contact", "consultation"),
        default="new_account",
        index=True,
    )
    source_page = Column(String(255), nullable=True)
    ip_address = Column(String(45), nullable=True)
    user_agent = Column(String(255), nullable=True)
    date_visit = Column(DateTime, server_default=func.now(), index=True)
