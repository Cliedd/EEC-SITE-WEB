from datetime import datetime, timezone
from fastapi import APIRouter, Depends, HTTPException, Request, status
from sqlalchemy import or_
from sqlalchemy.orm import Session

from ..database import get_db
from ..models.user import User
from ..models.admin import AdminUser
from ..schemas.auth import UserRegister, UserLogin, AdminLogin, TokenResponse, UserOut
from ..models.audit_log import AuditLog
from ..utils.security import hash_password, verify_password, create_access_token
from ..utils.audit import log_action

router = APIRouter(prefix="/auth", tags=["auth"])


@router.post("/register", response_model=UserOut, status_code=status.HTTP_201_CREATED)
def register(payload: UserRegister, request: Request, db: Session = Depends(get_db)):
    if db.query(User).filter(User.email == payload.email).first():
        raise HTTPException(
            status_code=status.HTTP_409_CONFLICT,
            detail="Un compte avec cet email existe déjà",
        )
    user = User(
        name_surName=payload.name_surName,
        email=payload.email,
        telephone=payload.telephone,
        mot_de_passe=hash_password(payload.mot_de_passe),
    )
    db.add(user)
    db.commit()
    db.refresh(user)
    log_action(
        db,
        action="USER_REGISTER",
        user_email=payload.email,
        entity_type="login",
        entity_id=user.idlogin,
        ip_address=request.client.host if request.client else None,
    )
    return user


@router.post("/login", response_model=TokenResponse)
def login(payload: UserLogin, request: Request, db: Session = Depends(get_db)):
    user = db.query(User).filter(User.email == payload.email, User.actif == 1).first()
    if not user or not verify_password(payload.mot_de_passe, user.mot_de_passe):
        log_action(
            db,
            action="USER_LOGIN",
            status="failure",
            user_email=payload.email,
            ip_address=request.client.host if request.client else None,
        )
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Email ou mot de passe incorrect",
        )
    token = create_access_token(
        {"sub": str(user.idlogin), "email": user.email, "role": "user"}
    )
    log_action(
        db,
        action="USER_LOGIN",
        user_id=user.idlogin,
        user_email=user.email,
        ip_address=request.client.host if request.client else None,
    )
    return TokenResponse(
        access_token=token,
        user_name=user.name_surName,
        role="user",
    )


@router.post("/admin/login", response_model=TokenResponse)
def admin_login(payload: AdminLogin, request: Request, db: Session = Depends(get_db)):
    # Accepte email ou nom d'utilisateur
    admin = (
        db.query(AdminUser)
        .filter(
            or_(AdminUser.email == payload.email, AdminUser.nom == payload.email),
            AdminUser.actif == 1,
        )
        .first()
    )
    ip = request.client.host if request.client else None

    if not admin or not verify_password(payload.mot_de_passe, admin.mot_de_passe):
        log_action(db, action="ADMIN_LOGIN", status="failure",
                   user_email=payload.email, ip_address=ip)
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Email ou mot de passe incorrect",
        )

    # Un seul commit groupé : mise à jour derniere_connexion + audit
    admin.derniere_connexion = datetime.now(timezone.utc)
    db.add(AuditLog(
        action="ADMIN_LOGIN",
        user_id=admin.id_admin,
        user_email=admin.email,
        ip_address=ip,
        status="success",
    ))
    db.commit()

    token = create_access_token(
        {"sub": str(admin.id_admin), "email": admin.email, "role": "admin"}
    )
    return TokenResponse(
        access_token=token,
        user_name=admin.nom,
        role="admin",
    )
