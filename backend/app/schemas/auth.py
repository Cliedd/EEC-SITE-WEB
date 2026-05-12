from pydantic import BaseModel, EmailStr, field_validator
import re


class UserRegister(BaseModel):
    name_surName: str
    email: EmailStr
    telephone: str
    mot_de_passe: str

    @field_validator("name_surName")
    @classmethod
    def name_min_length(cls, v: str) -> str:
        if len(v.strip()) < 3:
            raise ValueError("Le nom doit contenir au moins 3 caractères")
        return v.strip()

    @field_validator("telephone")
    @classmethod
    def telephone_valid(cls, v: str) -> str:
        digits = re.sub(r"\D", "", v)
        if len(digits) < 8:
            raise ValueError("Numéro de téléphone invalide")
        return v

    @field_validator("mot_de_passe")
    @classmethod
    def password_strength(cls, v: str) -> str:
        if len(v) < 8:
            raise ValueError("Le mot de passe doit contenir au moins 8 caractères")
        if len(v) > 128:
            raise ValueError("Le mot de passe est trop long")
        return v


class UserLogin(BaseModel):
    email: EmailStr
    mot_de_passe: str


class AdminLogin(BaseModel):
    email: str          # accepte email ou nom d'utilisateur
    mot_de_passe: str


class TokenResponse(BaseModel):
    access_token: str
    token_type: str = "bearer"
    user_name: str
    role: str


class UserOut(BaseModel):
    idlogin: int
    name_surName: str
    email: str
    telephone: str
    actif: int
    email_verified: int

    model_config = {"from_attributes": True}
