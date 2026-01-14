# 🚀 GUIDE GIT - PUSHER LE PROJET

**Version:** 1.0  
**Date:** 14 janvier 2026  
**Pour:** GitHub, GitLab, Gitea, etc.

---

## 📋 TABLE DES MATIÈRES

1. [Prérequis](#prérequis)
2. [Configuration Git Local](#configuration-git-local)
3. [Créer un Repository GitHub](#créer-un-repository-github)
4. [Première Fois: Push Initial](#première-fois-push-initial)
5. [Modifications Futures: Push](#modifications-futures-push)
6. [Bonnes Pratiques](#bonnes-pratiques)
7. [Dépannage](#dépannage)

---

## ✅ PRÉREQUIS

### 1️⃣ Vérifier que Git est Installé

```bash
git --version
# Résultat attendu: git version 2.x.x
```

**Si pas installé:**
- **Windows:** https://git-scm.com/download/win
- **Linux:** `sudo apt install git`
- **MacOS:** `brew install git`

### 2️⃣ Vérifier Configuration Git

```bash
git config --global user.name
git config --global user.email
```

**Si vides, configurer:**

```bash
git config --global user.name "Votre Nom"
git config --global user.email "votre.email@example.com"
```

### 3️⃣ Créer un Compte GitHub

- Aller à: https://github.com
- Cliquer "Sign up"
- Créer un compte gratuit

---

## 🔧 CONFIGURATION GIT LOCAL

### Étape 1: Initialiser le Repository

```bash
# Aller dans le dossier du projet
cd /chemin/vers/eec-site

# Initialiser git (si pas déjà fait)
git init
```

### Étape 2: Créer/Vérifier .gitignore

```bash
# Créer le fichier .gitignore
cat > .gitignore << 'EOF'
# Dépendances
vendor/
node_modules/
composer.lock

# Configuration sensible
.env
.env.local
.env.*.local

# Fichiers temporaires
writable/cache/*
writable/logs/*
writable/session/*
writable/debugbar/*

# Fichiers système
.DS_Store
Thumbs.db
*.swp
*.swo
*~

# IDE
.vscode/
.idea/
*.sublime-project
*.sublime-workspace

# Uploads temporaires
public/uploads/*
!public/uploads/.gitkeep

# Fichiers de test
coverage/
.phpunit.result.cache

# Backups
*.sql.bak
*.backup
EOF
```

### Étape 3: Vérifier le Statut Git

```bash
git status
```

**Résultat attendu:**
```
On branch master/main
No commits yet
```

---

## 🌐 CRÉER UN REPOSITORY GITHUB

### Étape 1: Créer le Repository sur GitHub

1. Aller à: https://github.com/new
2. **Repository name:** `eec-centre-medical` (ou votre nom)
3. **Description:** `Centre Médical EEC - Plateforme de rendez-vous médicaux`
4. **Visibilité:** 
   - Public (si vous voulez partager)
   - Private (si confidentiel)
5. **Ne pas cocher:**
   - "Initialize this repository with a README"
   - "Add .gitignore"
   - "Add a license"
6. Cliquer **"Create repository"**

### Étape 2: Copier l'URL du Repository

Après la création, vous verrez:
```
https://github.com/votre-username/eec-centre-medical.git
```

Copier cette URL.

---

## 🚀 PREMIÈRE FOIS: PUSH INITIAL

### Étape 1: Ajouter Tous les Fichiers

```bash
# Ajouter tous les fichiers (sauf .gitignore)
git add .

# Vérifier quels fichiers seront ajoutés
git status
```

**À vérifier:**
- ✅ eecbafoussam.sql
- ✅ .env (devrait être IGNORÉ)
- ✅ vendor/ (devrait être IGNORÉ)
- ✅ writable/logs/ (devrait être IGNORÉ)
- ✅ Tous les fichiers .md

### Étape 2: Créer le Commit Initial

```bash
git commit -m "Initial commit: EEC Centre Médical - Version 1.0 Production Ready"
```

**Résultat attendu:**
```
[main (root-commit) abc123d] Initial commit: EEC Centre Médical - Version 1.0 Production Ready
 XX files changed, XXX insertions(+)
 create mode 100644 README.md
 create mode 100644 DEPLOIEMENT.md
 ...
```

### Étape 3: Ajouter l'URL du Repository Distant

```bash
# Ajouter le remote
git remote add origin https://github.com/votre-username/eec-centre-medical.git

# Vérifier
git remote -v
```

**Résultat attendu:**
```
origin  https://github.com/votre-username/eec-centre-medical.git (fetch)
origin  https://github.com/votre-username/eec-centre-medical.git (push)
```

### Étape 4: Pousser sur GitHub

```bash
# Pousser le code initial (branche main)
git branch -M main
git push -u origin main
```

**Première fois? Vous devrez entrer vos identifiants GitHub:**
- Username: Votre nom GitHub
- Password: Votre token personnel (voir plus bas)

**Résultat attendu:**
```
Enumerating objects: XX, done.
Counting objects: 100% (XX/XX), done.
...
To https://github.com/votre-username/eec-centre-medical.git
 * [new branch]      main -> main
Branch 'main' set up to track remote branch 'main' from 'origin'.
```

✅ **PUSH INITIAL RÉUSSI!**

---

## 🔐 UTILISER UN TOKEN PERSONNEL (RECOMMANDÉ)

Au lieu du mot de passe, utiliser un Personal Access Token (plus sécurisé).

### Créer un Token

1. Aller à: https://github.com/settings/tokens
2. Cliquer **"Generate new token"** → **"Generate new token (classic)"**
3. **Note:** `EEC-Centre-Medical`
4. **Expiration:** 90 jours ou Plus
5. **Scopes:** Cocher:
   - ✅ `repo` (Full control of private repositories)
   - ✅ `workflow` (Update GitHub Action workflows)
6. Cliquer **"Generate token"**
7. **COPIER le token** (vous ne pourrez plus le voir!)

### Utiliser le Token

Quand Git demande le mot de passe, entrer:
```
Username: votre-username
Password: ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (le token)
```

**Ou configurer git pour le mémoriser:**

```bash
# Configurer le credential helper
git config --global credential.helper store

# Ensuite, git mémorisera vos identifiants
# (sécurisé pour usage personnel)
```

---

## 📝 MODIFICATIONS FUTURES: PUSH

Après vos modifications, faire:

### Étape 1: Vérifier les Modifications

```bash
git status

# Voir les changements détaillés
git diff
```

### Étape 2: Ajouter les Fichiers Modifiés

```bash
# Option 1: Ajouter fichier spécifique
git add DEPLOIEMENT.md

# Option 2: Ajouter tous les changements
git add .
```

### Étape 3: Créer un Commit

```bash
# Format: git commit -m "Description claire du changement"
git commit -m "Correction: Mise à jour documentation DEPLOIEMENT.md"
```

**Bons messages de commit:**
```bash
git commit -m "Feature: Ajouter 5 nouveaux services médicaux"
git commit -m "Fix: Corriger bug authentification admin"
git commit -m "Docs: Mettre à jour guide installation"
git commit -m "Refactor: Améliorer structure base de données"
git commit -m "Perf: Optimiser indices SQL"
```

### Étape 4: Pousser sur GitHub

```bash
git push origin main
```

**Résultat attendu:**
```
Enumerating objects: 3, done.
...
To https://github.com/votre-username/eec-centre-medical.git
   abc123d..def456e  main -> main
```

---

## 🎯 BONNES PRATIQUES GIT

### 1️⃣ Commits Fréquents et Clairs

```bash
# BON: Commits petits et spécifiques
git commit -m "Ajouter validation email inscription"
git commit -m "Corriger CSS responsive menu mobile"
git commit -m "Documenter API rendez-vous"

# MAUVAIS: Commits gros et vagues
git commit -m "Modifications diverses"
git commit -m "WIP"
```

### 2️⃣ Ne Jamais Pousser les Fichiers Sensibles

```bash
# ❌ NE PAS faire
git add .env
git add database_password.txt

# ✅ FAIRE
# Ajouter à .gitignore
echo ".env" >> .gitignore
echo "vendor/" >> .gitignore
```

### 3️⃣ Créer des Branches pour les Développements

```bash
# Créer une branche pour une feature
git checkout -b feature/ajouter-services

# Travailler sur la branche
# Puis pusher
git push origin feature/ajouter-services

# Créer une Pull Request sur GitHub
# Puis merger dans main
```

### 4️⃣ Lire avant de Pousser

```bash
# Voir les changements avant de commit
git diff

# Voir les commits non pushés
git log origin/main..main

# Voir l'historique
git log --oneline -10
```

### 5️⃣ Tags pour les Versions

```bash
# Créer un tag pour une version
git tag -a v1.0.0 -m "Version 1.0 Production Ready"

# Pousser les tags
git push origin v1.0.0

# Ou pousser tous les tags
git push origin --tags
```

---

## 🔄 WORKFLOW COMPLET TYPIQUE

### Jour 1: Push Initial

```bash
cd /chemin/vers/eec-site

# Initialiser
git init
git add .
git commit -m "Initial commit: EEC Centre Médical v1.0"
git remote add origin https://github.com/user/eec-centre-medical.git
git branch -M main
git push -u origin main

echo "✅ Projet pushé sur GitHub!"
```

### Jour 2+: Après Modifications

```bash
# Faire vos modifications dans l'éditeur
# ...

# Puis:
git status                          # Vérifier
git add .                           # Ajouter
git commit -m "Description"         # Commit
git push origin main                # Push
```

---

## 🐛 DÉPANNAGE GIT

### "Erreur: Repository already exists"

```bash
# Le repository est déjà initialisé
# Continuer avec git add/commit/push

# Ou si vous voulez recommencer:
rm -rf .git
git init
```

### "Erreur: Remote origin already exists"

```bash
# Le remote est déjà configuré
# Vérifier:
git remote -v

# Ou supprimer et recréer:
git remote remove origin
git remote add origin https://github.com/user/repo.git
```

### "Erreur: fatal: Not a git repository"

```bash
# Git n'a pas initialisé
git init
git add .
git commit -m "Initial commit"
```

### "Erreur: Fichier .env poussé par erreur"

```bash
# Supprimer le fichier du history (ATTENTION!)
git rm --cached .env
git commit -m "Remove .env file"
git push origin main

# Ajouter à .gitignore pour la prochaine fois
echo ".env" >> .gitignore
```

### "Erreur: Authentication failed"

```bash
# Vérifier les identifiants
git config --global user.name
git config --global user.email

# Utiliser un Personal Access Token au lieu du mot de passe
# Voir section "UTILISER UN TOKEN PERSONNEL"

# Ou configurer SSH (avancé):
ssh-keygen -t ed25519 -C "votre.email@example.com"
# Puis ajouter la clé publique sur GitHub
```

### "Erreur: fatal: unable to access repository"

```bash
# Vérifier la connexion internet
ping github.com

# Vérifier l'URL du repository
git remote -v

# Corriger si nécessaire
git remote set-url origin https://github.com/user/repo.git
```

---

## 📊 COMMANDES GIT ESSENTIELLES

| Commande | Effet |
|----------|-------|
| `git status` | Voir l'état du repository |
| `git add .` | Ajouter tous les fichiers |
| `git commit -m "msg"` | Créer un commit |
| `git push origin main` | Pousser sur GitHub |
| `git pull origin main` | Télécharger les changements |
| `git log --oneline` | Voir l'historique |
| `git diff` | Voir les changements |
| `git branch` | Voir les branches |
| `git checkout -b branch` | Créer une branche |
| `git merge branch` | Fusionner une branche |

---

## 🎓 GUIDES SUPPLÉMENTAIRES

### Cloner le Repository Ailleurs

```bash
# Cloner le repository
git clone https://github.com/user/eec-centre-medical.git

# Aller dans le dossier
cd eec-centre-medical

# Installer les dépendances
composer install

# Créer le .env
cp .env.example .env

# Configurer la base
mysql -u root -p < eecbafoussam.sql

# Démarrer
php spark serve --port 9000
```

### Synchroniser avec une Fork

```bash
# Ajouter le repository original
git remote add upstream https://github.com/original/repo.git

# Télécharger les changements
git fetch upstream

# Fusionner dans votre branche
git merge upstream/main
```

### Créer un Release sur GitHub

1. Aller au repository
2. Cliquer **"Releases"**
3. Cliquer **"Create a new release"**
4. **Tag version:** `v1.0.0`
5. **Release title:** `Version 1.0 - Production Ready`
6. **Description:** Ajouter les changements
7. Cliquer **"Publish release"**

---

## ✨ RÉSUMÉ RAPIDE

### Première Fois

```bash
cd /chemin/vers/eec-site
git init
git add .
git commit -m "Initial commit: EEC Centre Médical"
git remote add origin https://github.com/user/eec-centre-medical.git
git branch -M main
git push -u origin main
```

### Modifications Futures

```bash
git add .
git commit -m "Description du changement"
git push origin main
```

### Voir l'État

```bash
git status
git log --oneline
git diff
```

---

## 📚 RESSOURCES SUPPLÉMENTAIRES

- **Git Guide:** https://git-scm.com/book
- **GitHub Docs:** https://docs.github.com
- **Interactive Git:** https://learngitbranching.js.org
- **Commit Messages:** https://www.conventionalcommits.org

---

**✅ Votre projet est maintenant sur GitHub!**

Pour plus d'aide, consultez la documentation GitHub officielle.
