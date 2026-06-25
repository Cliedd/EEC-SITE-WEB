"""
Seed de la base de données locale (développement / soutenance).

Ce script :
  1. crée la base de données si elle n'existe pas,
  2. crée les 8 tables à partir des modèles SQLAlchemy,
  3. insère le compte admin et les 15 spécialités du CMPB.

Usage (depuis le dossier backend/) :
    pip install -r requirements.txt
    python db/seed.py

⚠️ Configure d'abord backend/.env (voir db/README.md). Le script lit DATABASE_URL.
"""
import os
import sys

# Permet d'importer le package `app` quel que soit le dossier d'exécution
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))

import pymysql  # noqa: E402
pymysql.install_as_MySQLdb()

from sqlalchemy import create_engine, text  # noqa: E402
from sqlalchemy.engine import make_url  # noqa: E402
from sqlalchemy.orm import sessionmaker  # noqa: E402

from app.config import settings  # noqa: E402
from app.database import Base  # noqa: E402
import app.models  # noqa: E402,F401  — enregistre tous les modèles dans Base.metadata
from app.models.admin import AdminUser  # noqa: E402
from app.models.service import Service  # noqa: E402
from app.utils.security import hash_password  # noqa: E402

ADMIN_EMAIL = "admin@eec-cmpb.cm"
ADMIN_PASSWORD = "Admin@2026"

SPECIALTIES = [
    "Médecine interne",
    "Maternité",
    "Pédiatrie/Neonatalogie",
    "Chirurgie",
    "Urgences",
    "Imagerie médicale",
    "Soins intensifs",
    "Neurologie",
    "Nutrition",
    "Kinesitherapeute",
    "Pharmacie",
    "Vaccination",
    "UPEC",
    "Administration",
    "Aumonerie",
]


def main():
    if not settings.DATABASE_URL:
        sys.exit("❌ DATABASE_URL est vide. Configure backend/.env (voir db/README.md).")

    url = make_url(settings.DATABASE_URL)
    db_name = url.database

    # 1) Créer la base si elle n'existe pas (connexion au serveur sans base)
    server_engine = create_engine(url.set(database=None))
    with server_engine.connect() as conn:
        conn.execute(text(
            f"CREATE DATABASE IF NOT EXISTS `{db_name}` "
            "CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
        ))
        conn.commit()
    print(f"✓ Base '{db_name}' prête")

    # 2) Créer les tables
    engine = create_engine(settings.DATABASE_URL)
    Base.metadata.create_all(engine)
    print(f"✓ {len(Base.metadata.tables)} tables créées/vérifiées")

    # 3) Seed admin + services
    db = sessionmaker(bind=engine)()
    try:
        if not db.query(AdminUser).filter_by(email=ADMIN_EMAIL).first():
            db.add(AdminUser(
                email=ADMIN_EMAIL,
                mot_de_passe=hash_password(ADMIN_PASSWORD),
                nom="Administrateur",
                role="super_admin",
                actif=1,
            ))
            print(f"✓ Compte admin créé : {ADMIN_EMAIL} / {ADMIN_PASSWORD}")
        else:
            print(f"• Compte admin déjà présent : {ADMIN_EMAIL}")

        created = 0
        for i, name in enumerate(SPECIALTIES):
            if not db.query(Service).filter_by(name=name).first():
                db.add(Service(name=name, is_active=1, ordre_affichage=i))
                created += 1
        db.commit()
        print(f"✓ Services : {created} ajouté(s), {db.query(Service).count()} au total")
    finally:
        db.close()

    print("\n✅ Seed terminé. Lance le backend : uvicorn app.main:app --reload --port 8000")


if __name__ == "__main__":
    main()
