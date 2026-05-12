from sqlalchemy import Column, Integer, String, DateTime, SmallInteger
from sqlalchemy.sql import func
from ..database import Base


class AdminUser(Base):
    __tablename__ = "admin_users"

    id_admin = Column(Integer, primary_key=True, autoincrement=True)
    email = Column(String(100), nullable=False, unique=True, index=True)
    mot_de_passe = Column(String(255), nullable=False)
    nom = Column(String(100), nullable=False)
    role = Column(String(50), default="admin")
    date_creation = Column(DateTime, server_default=func.now())
    date_modification = Column(DateTime, nullable=True)
    actif = Column(SmallInteger, default=1)
    derniere_connexion = Column(DateTime, nullable=True)
