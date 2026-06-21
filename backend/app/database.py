\Z  import pymysql
pymysql.install_as_MySQLdb()

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, DeclarativeBase
from typing import Generator


class Base(DeclarativeBase):
    pass
\

_engine = None
_SessionLocal = None


def _get_engine():
    global _engine
    if _engine is None:
        from .config import settings
        _engine = create_engine(
            settings.DATABASE_URL,
            pool_pre_ping=True,
            pool_recycle=300,
            pool_size=5,
            max_overflow=10,
        )
    return _engine


def get_db() -> Generator:
    global _SessionLocal
    if _SessionLocal is None:
        _SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=_get_engine())
    db = _SessionLocal()
    try:
        yield db
    finally:
        db.close()
