from sqlalchemy import Column, Integer, String, DateTime, SmallInteger
from sqlalchemy.sql import func
from ..database import Base


class User(Base):
    __tablename__ = "login"

    idlogin = Column(Integer, primary_key=True, autoincrement=True)
    name_surName = Column(String(100), nullable=False)
    email = Column(String(100), nullable=False, unique=True, index=True)
    telephone = Column(String(20), nullable=False)
    mot_de_passe = Column(String(255), nullable=False)
    date_creation = Column(DateTime, server_default=func.now())
    date_modification = Column(DateTime, nullable=True)
    date_logout = Column(DateTime, nullable=True)
    actif = Column(SmallInteger, default=1)
    email_verified = Column(SmallInteger, default=0)
