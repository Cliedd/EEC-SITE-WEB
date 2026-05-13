import os
from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import JSONResponse

from .config import settings
from .routers import auth, appointments, contacts, services, admin
from .middleware.rate_limit import rate_limit_check

IS_DEV = os.getenv("VERCEL_ENV") is None and os.getenv("ENVIRONMENT", "development") == "development"

# Docs uniquement en développement
app = FastAPI(
    title="EEC Centre Médical — API",
    description="API REST pour le Centre Médical Protestant de Bafoussam",
    version="2.0.0",
    docs_url="/api/docs" if IS_DEV else None,
    redoc_url="/api/redoc" if IS_DEV else None,
    openapi_url="/api/openapi.json" if IS_DEV else None,
)

# CORS — localhost uniquement en développement
allowed_origins = [settings.FRONTEND_URL]
if IS_DEV:
    allowed_origins.append("http://localhost:5173")

app.add_middleware(
    CORSMiddleware,
    allow_origins=allowed_origins,
    allow_credentials=True,
    allow_methods=["GET", "POST", "PATCH", "DELETE", "OPTIONS"],
    allow_headers=["Authorization", "Content-Type"],
)

# Security headers
@app.middleware("http")
async def add_security_headers(request: Request, call_next):
    response = await call_next(request)
    response.headers["X-Content-Type-Options"] = "nosniff"
    response.headers["X-Frame-Options"] = "DENY"
    response.headers["X-XSS-Protection"] = "1; mode=block"
    response.headers["Referrer-Policy"] = "strict-origin-when-cross-origin"
    response.headers["Permissions-Policy"] = "geolocation=(), microphone=(), camera=()"
    if not IS_DEV:
        response.headers["Strict-Transport-Security"] = "max-age=31536000; includeSubDomains"
    return response


# Rate limiting middleware
@app.middleware("http")
async def apply_rate_limit(request: Request, call_next):
    try:
        rate_limit_check(request)
    except Exception as exc:
        # Re-raise HTTPException so FastAPI handles it correctly
        from fastapi import HTTPException
        if isinstance(exc, HTTPException):
            return JSONResponse(status_code=exc.status_code, content={"detail": exc.detail})
        raise
    return await call_next(request)


# Masquer les détails de validation Pydantic en production
@app.exception_handler(422)
async def validation_exception_handler(request: Request, exc):
    return JSONResponse(
        status_code=422,
        content={"detail": "Données invalides. Vérifiez les champs du formulaire."},
    )


# Handler 500 — retourne le message d'erreur en JSON (utile pour debug)
@app.exception_handler(500)
async def internal_error_handler(request: Request, exc):
    import traceback
    err = traceback.format_exc()
    return JSONResponse(
        status_code=500,
        content={"detail": str(exc), "trace": err[-1000:] if not IS_DEV else err},
    )


# Routers
app.include_router(auth.router, prefix="/api")
app.include_router(appointments.router, prefix="/api")
app.include_router(contacts.router, prefix="/api")
app.include_router(services.router, prefix="/api")
app.include_router(admin.router, prefix="/api")


@app.post("/api/setup/init")
def setup_init():
    """Endpoint temporaire — recrée toutes les tables + admin depuis zéro."""
    import bcrypt
    from .database import _get_engine, Base
    from .models import admin as _a, user as _u, appointment as _ap  # noqa
    from .models import contact as _c, service as _s, visitor as _v  # noqa
    from .models import audit_log as _al, email_verification as _ev  # noqa
    from .models.admin import AdminUser
    from .models.service import Service
    from sqlalchemy.orm import sessionmaker

    result = {}
    try:
        engine = _get_engine()
        Base.metadata.drop_all(engine)
        Base.metadata.create_all(engine)
        result["tables_recreated"] = True
    except Exception as e:
        result["error"] = str(e)
        return result

    Session = sessionmaker(bind=_get_engine())
    db = Session()
    try:
        pwd = bcrypt.hashpw(b"Admin@2026", bcrypt.gensalt()).decode()
        db.add(AdminUser(email="admin@eec-cmpb.cm", mot_de_passe=pwd,
                         nom="Administrateur", role="super_admin", actif=1))
        services = ["Consultation Générale","Pédiatrie","Gynécologie-Obstétrique",
                    "Chirurgie Générale","Médecine Interne","Radiologie",
                    "Laboratoire d'Analyses","Urgences 24h/24","Kinésithérapie",
                    "Ophtalmologie","ORL","Dermatologie","Cardiologie"]
        for i, name in enumerate(services):
            db.add(Service(name=name, is_active=1, ordre_affichage=i))
        db.commit()
        result["success"] = True
        result["credentials"] = {"email": "admin@eec-cmpb.cm", "password": "Admin@2026"}
    except Exception as e:
        import traceback
        result["db_error"] = str(e)
        result["trace"] = traceback.format_exc()[-1000:]
    finally:
        db.close()
    return result


@app.get("/api/health")
def health():
    return {"status": "ok", "service": "EEC Centre Médical API"}


@app.get("/api/debug")
def debug():
    return {
        "database_url_set": bool(settings.DATABASE_URL),
        "secret_key_set": settings.SECRET_KEY != "fallback-secret-change-in-production",
        "environment": settings.ENVIRONMENT,
        "frontend_url": settings.FRONTEND_URL,
    }


