from sqlalchemy import Column, Integer, String, DateTime, SmallInteger, Enum
from sqlalchemy.sql import func
from ..database import Base


class EmailVerification(Base):
    __tablename__ = "email_verifications"

    id_verification = Column(Integer, primary_key=True, autoincrement=True)
    email = Column(String(100), nullable=False, index=True)
    token = Column(String(64), nullable=False, unique=True, index=True)
    entity_type = Column(
        Enum("login", "admin", "contact"),
        default="login",
    )
    entity_id = Column(Integer, nullable=True)
    verified = Column(SmallInteger, default=0)
    verified_at = Column(DateTime, nullable=True)
    expires_at = Column(DateTime, nullable=False, index=True)
    created_at = Column(DateTime, server_default=func.now())
