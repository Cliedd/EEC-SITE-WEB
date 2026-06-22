from pydantic_settings import BaseSettings
from pydantic import field_validator
from functools import lru_cache


class Settings(BaseSettings):
    # Valeurs par défaut vides — évite le crash au démarrage si variables manquantes
    DATABASE_URL: str = ""

    @field_validator("DATABASE_URL")
    @classmethod
    def _normalize_db_url(cls, v: str) -> str:
        # Railway/MySQL exposent une URL `mysql://...` ; SQLAlchemy doit utiliser
        # explicitement le driver pymysql. On normalise le schéma au boot.
        if v.startswith("mysql://"):
            return v.replace("mysql://", "mysql+pymysql://", 1)
        return v
    SECRET_KEY: str = "fallback-secret-change-in-production"
    ALGORITHM: str = "HS256"
    ACCESS_TOKEN_EXPIRE_MINUTES: int = 60

    SMTP_HOST: str = "smtp.gmail.com"
    SMTP_PORT: int = 587
    SMTP_USER: str = ""
    SMTP_PASS: str = ""

    FRONTEND_URL: str = "http://localhost:5173"
    ENVIRONMENT: str = "development"

    class Config:
        env_file = ".env"
        env_file_encoding = "utf-8"


@lru_cache()
def get_settings() -> Settings:
    return Settings()


settings = get_settings()
