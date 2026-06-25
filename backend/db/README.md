# Base de données — Installation locale

Ce dossier sert à monter la base de données en local (développement, démo, soutenance).

Deux options : **A** (MySQL local, fonctionne sans internet — recommandé pour une soutenance)
ou **B** (utiliser directement la base Railway en ligne, le plus rapide mais nécessite internet).

Identifiants admin (dans les deux cas) : **`admin@eec-cmpb.cm` / `Admin@2026`**

---

## Option A — MySQL local (recommandé, hors-ligne) ✅

### Prérequis
Un serveur MySQL (ou MariaDB). Au choix :
- MySQL installé nativement, ou un pack **XAMPP / WAMP / MAMP**, ou
- Docker :
  ```bash
  docker run --name eec-mysql -e MYSQL_ROOT_PASSWORD=root \
    -e MYSQL_DATABASE=eecbafoussam -p 3306:3306 -d mysql:8
  ```

### Étape 1 — Configurer `backend/.env`
Copier `backend/.env.example` vers `backend/.env` et y mettre :
```env
DATABASE_URL=mysql+pymysql://root:TON_MOT_DE_PASSE@localhost:3306/eecbafoussam
SECRET_KEY=dev-secret-key-pour-le-local
ENVIRONMENT=development
FRONTEND_URL=http://localhost:5173
```
> Si ton MySQL root n'a **pas** de mot de passe : `mysql+pymysql://root:@localhost:3306/eecbafoussam`

### Étape 2 — Remplir la base (2 méthodes, au choix)

**Méthode 1 — Script de seed (le plus simple, crée la base + tables + données)**
```bash
cd backend
pip install -r requirements.txt
python db/seed.py
```
Le script crée la base `eecbafoussam` si besoin, crée les 8 tables, puis insère
le compte admin et les 15 spécialités.

**Méthode 2 — Importer le dump SQL complet** (réplique exacte de la base en ligne)
```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS eecbafoussam CHARACTER SET utf8mb4;"
mysql -u root -p eecbafoussam < backend/db/eecbafoussam.sql
```

---

## Option B — Base Railway en ligne (le plus rapide, nécessite internet)

Aucune installation de MySQL : on pointe le backend local directement sur la base déployée.
Dans `backend/.env`, mettre comme `DATABASE_URL` l'URL **publique** du service MySQL,
à récupérer dans le **dashboard Railway** → projet `dependable-serenity` → service **MySQL**
→ onglet **Variables** → `MYSQL_PUBLIC_URL` (format `mysql://root:****@xxxx.proxy.rlwy.net:PORT/railway`).

> Remplacer le préfixe `mysql://` par `mysql+pymysql://` (le backend normalise aussi automatiquement).
>
> ⚠️ C'est la base de **production partagée** : tout ce qui est créé pendant la démo
> (rendez-vous, messages…) est réel. Pour une démo isolée, préférer l'option A.

---

## Lancer le projet en local

**Backend** (port 8000) :
```bash
cd backend
pip install -r requirements.txt
uvicorn app.main:app --reload --port 8000
```
Vérifier : http://localhost:8000/api/health → `{"status":"ok",...}`

**Frontend** (port 5173) :
```bash
cd frontend
npm install
npm run dev
```
Ouvrir http://localhost:5173. Le frontend proxifie automatiquement `/api` vers le
backend `:8000` (configuré dans `frontend/vite.config.ts`).

---

## Schéma de la base (8 tables)
`login` (patients) · `admin_users` · `services` · `appointments` · `contacts`
· `visitors` · `email_verifications` · `audit_logs`
