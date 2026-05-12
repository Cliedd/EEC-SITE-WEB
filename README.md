# EEC — Centre Médical Protestant de Bafoussam

Site web officiel du Centre Médical Protestant de Bafoussam (CMPB), une œuvre de l'Église Évangélique du Cameroun.

## Stack technique

| Couche | Technologie |
|--------|-------------|
| Frontend | React 18 · TypeScript · Vite · Tailwind CSS |
| Backend | FastAPI · SQLAlchemy · Pydantic v2 |
| Base de données | MySQL |
| Auth | JWT Bearer tokens · bcrypt |
| Déploiement | Vercel (frontend SPA + backend serverless) |

## Structure du projet

```
EEC-SITE-WEB/
├── frontend/          # React 18 + TypeScript
│   ├── public/        # Images, logo, favicon
│   └── src/
│       ├── components/   # UI + Layout
│       ├── pages/        # Pages publiques + admin/
│       ├── hooks/        # React Query hooks
│       ├── services/     # Appels API (axios)
│       ├── context/      # AuthContext (JWT)
│       └── types/        # Interfaces TypeScript
│
└── backend/           # FastAPI + Python
    ├── api/index.py   # Entry point Vercel
    ├── app/
    │   ├── models/    # SQLAlchemy (tables MySQL)
    │   ├── schemas/   # Validation Pydantic
    │   ├── routers/   # auth, appointments, contacts, services, admin
    │   ├── utils/     # security, email, audit
    │   └── middleware/# Rate limiting
    └── vercel.json
```

## Lancer le projet en local

### Prérequis

- Python 3.11+
- Node.js 18+
- MySQL

### Backend

```bash
cd backend
pip install -r requirements.txt
cp .env.example .env   # puis remplir les variables
uvicorn app.main:app --reload --port 8000
```

Variables `.env` :

```env
DATABASE_URL=mysql+pymysql://user:password@localhost/eecbafoussam
SECRET_KEY=une-cle-secrete-longue-et-aleatoire
ALGORITHM=HS256
ACCESS_TOKEN_EXPIRE_MINUTES=60
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=
SMTP_PASS=
FRONTEND_URL=http://localhost:5173
ENVIRONMENT=development
```

### Frontend

```bash
cd frontend
npm install
cp .env.example .env   # optionnel en local
npm run dev
```

L'application sera disponible sur `http://localhost:5173`.

## Déploiement sur Vercel

### Backend

1. Importer le dossier `backend/` comme projet Vercel
2. Ajouter les variables d'environnement dans **Settings → Environment Variables** :

```
DATABASE_URL       mysql+pymysql://user:pass@host/db  (ex: PlanetScale, Railway)
SECRET_KEY         [clé aléatoire min. 32 caractères]
FRONTEND_URL       https://votre-frontend.vercel.app
ENVIRONMENT        production
SMTP_USER          votre@gmail.com
SMTP_PASS          [mot de passe application Gmail]
```

### Frontend

1. Importer le dossier `frontend/` comme projet Vercel
2. Ajouter la variable d'environnement :

```
VITE_API_URL    https://votre-backend.vercel.app/api
```

> **Base de données** : Vercel ne supporte pas MySQL local. Utiliser [PlanetScale](https://planetscale.com) ou [Railway](https://railway.app) pour héberger la base MySQL.

## Fonctionnalités

**Site public**
- Page d'accueil avec carousel de photos
- Présentation du centre et de l'équipe dirigeante
- Liste des services médicaux
- Formulaire de prise de rendez-vous
- Formulaire de contact avec accusé de réception par email
- Espace patient (parcours de visite, galerie)

**Dashboard administrateur**
- Statistiques en temps réel (visiteurs, rendez-vous, messages)
- Gestion des rendez-vous (confirmer / annuler)
- Gestion des messages (lu / répondu)
- Gestion des services (ajouter / activer / supprimer)
- Journal d'audit des actions
- Liste des visiteurs

## Sécurité

- Authentification JWT avec expiration configurable
- Hachage bcrypt des mots de passe (compatible PHP `password_hash`)
- Rate limiting par IP sur les endpoints sensibles
- Headers HTTP de sécurité (X-Frame-Options, X-Content-Type-Options, HSTS…)
- CORS strict (origines explicites)
- Validation stricte des inputs (Pydantic v2)
- Docs API (`/api/docs`) désactivées en production
- Échappement HTML dans les emails

## Accès administrateur

URL : `/login`

| Champ | Valeur |
|-------|--------|
| Identifiant | `administrationeecc@dashboard.com` |
| Mot de passe | *(défini en base de données)* |

## Licence

Projet propriétaire — Église Évangélique du Cameroun · Centre Médical Protestant de Bafoussam
