# 🚀 GUIDE INSTALLATION COMPLET - EEC Centre Médical

**Version:** 1.0  
**Dernière mise à jour:** January 13, 2026  
**Compatibilité:** Windows | Linux | MacOS

---

## 📋 TABLE DES MATIÈRES

1. [Prérequis Système](#prérequis-système)
2. [Installation Windows (WAMP)](#installation-windows-wamp)
3. [Installation Linux](#installation-linux)
4. [Configuration Base de Données](#configuration-base-de-données)
5. [Installation du Projet](#installation-du-projet)
6. [Démarrage du Serveur](#démarrage-du-serveur)
7. [Vérification Installation](#vérification-installation)
8. [Dépannage](#dépannage)

---

## 🔧 PRÉREQUIS SYSTÈME

### Logiciels Requis
```
✅ PHP 8.1 minimum (8.2+ recommandé)
✅ MySQL 5.7+ OU MariaDB 10.3+
✅ Composer (gestionnaire de dépendances PHP)
✅ Git (pour cloner le projet)
```

### Extensions PHP Requises
```
✅ php-mysql (ou php-mysqli)
✅ php-intl
✅ php-curl
✅ php-gd
✅ php-mbstring
✅ php-xml
✅ php-zip
```

### Espace Disque Requis
```
~150 MB (avec dépendances Composer)
```

---

## 🪟 INSTALLATION WINDOWS (WAMP)

### Étape 1: Installer WAMP

1. **Télécharger WAMP Server**
   - Aller sur: https://www.wampserver.com/en/
   - Télécharger la version 64-bit (ou 32-bit selon votre PC)

2. **Installer WAMP**
   - Exécuter l'installateur téléchargé
   - Accepter les conditions
   - Installer dans: `C:\wamp64` (par défaut)
   - Installer tous les composants

3. **Démarrer WAMP**
   - Lancer WampServer depuis le menu Démarrer
   - Attendre que l'icône devienne **verte** dans la barre des tâches

### Étape 2: Vérifier PHP & MySQL

Ouvrir PowerShell (Admin) et taper:

```powershell
# Vérifier PHP
C:\wamp64\bin\php\php8.2.x\php.exe -v

# Vérifier MySQL
C:\wamp64\bin\mysql\mysql8.0.x\bin\mysql.exe --version
```

Vous devez voir les numéros de version.

### Étape 3: Installer Composer (Global)

1. Télécharger: https://getcomposer.org/download/
2. Exécuter l'installateur
3. Quand demandé: Spécifier le chemin PHP: `C:\wamp64\bin\php\php8.2.x\php.exe`
4. Tester dans PowerShell:
   ```powershell
   composer --version
   ```

### Étape 4: Installer Git

1. Télécharger: https://git-scm.com/download/win
2. Exécuter l'installateur (garder les paramètres par défaut)
3. Tester dans PowerShell:
   ```powershell
   git --version
   ```

### Étape 5: Cloner le Projet

Ouvrir PowerShell (n'importe où) et taper:

```powershell
# Aller au dossier www de WAMP
cd C:\wamp64\www

# Cloner le projet
git clone https://github.com/votre-repo/eec-centre-medical.git eec-site

# Entrer dans le dossier
cd eec-site
```

### Étape 6: Installer les Dépendances PHP

```powershell
composer install
```

Attendre que les fichiers `vendor/` se téléchargent (~30 secondes).

### Étape 7: Configurer l'Environnement

1. Copier le fichier d'exemple:
   ```powershell
   copy .env.example .env
   ```

2. Éditer `.env` avec Notepad++:
   ```ini
   # Base de Données
   database.default.hostname = localhost
   database.default.database = eecbafoussam
   database.default.username = root
   database.default.password = 
   
   # Application
   app.baseURL = http://localhost:9000/eec-site/
   app.environment = development
   
   # Email (Gmail SMTP)
   email.protocol = smtp
   email.SMTPHost = smtp.gmail.com
   email.SMTPUser = votre-email@gmail.com
   email.SMTPPass = votre-app-password
   email.SMTPPort = 587
   email.SMTPCrypto = tls
   ```

**⚠️ NOTE:** Pour Gmail, créer un [App Password](https://myaccount.google.com/apppasswords) (pas votre mot de passe normal)

### Étape 8: Créer la Base de Données

1. Ouvrir phpMyAdmin:
   - Cliquer sur l'icône WAMP (vert) → phpMyAdmin
   - Ou aller à: http://localhost/phpmyadmin

2. Créer une base de données:
   - Onglet "Bases de données"
   - Nom: `eecbafoussam`
   - Collation: `utf8mb4_unicode_ci`
   - Cliquer "Créer"

3. Sélectionner la base: `eecbafoussam`

4. Onglet "Importer" et uploader: `eecbafoussam.sql`
   - Cliquer "Exécuter"
   - Attendre le succès ✅

### Étape 9: Démarrer le Serveur

Ouvrir PowerShell dans le dossier du projet:

```powershell
php spark serve --host localhost --port 9000
```

**Sortie attendue:**
```
CodeIgniter v4.6.1 Command Line Tool - Server Time: 2026-01-13 10:30:00

Server started on http://localhost:9000
Press Ctrl+C to stop
```

### Étape 10: Accéder au Site

- **Site Principal:** http://localhost:9000/
- **Tableau de Bord Admin:** http://localhost:9000/admin
  - Email: `administrationeecc@dashboard.com`
  - Mot de passe: `bafoussameec2026@web`

✅ **INSTALLATION WINDOWS TERMINÉE!**

---

## 🐧 INSTALLATION LINUX

### Étape 1: Mettre à Jour le Système

```bash
sudo apt update && sudo apt upgrade -y
```

### Étape 2: Installer Apache & PHP

```bash
# Installer Apache & PHP
sudo apt install -y apache2 php8.2 php8.2-cli php8.2-common php8.2-mysql php8.2-intl php8.2-curl php8.2-gd php8.2-mbstring php8.2-xml php8.2-zip

# Activer les modules Apache requis
sudo a2enmod rewrite
sudo a2enmod headers

# Redémarrer Apache
sudo systemctl restart apache2
```

### Étape 3: Installer MySQL/MariaDB

```bash
# Installer MariaDB
sudo apt install -y mariadb-server

# Sécuriser l'installation (optionnel mais recommandé)
sudo mysql_secure_installation
```

### Étape 4: Installer Composer

```bash
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Vérifier
composer --version
```

### Étape 5: Installer Git

```bash
sudo apt install -y git

# Vérifier
git --version
```

### Étape 6: Cloner le Projet

```bash
# Aller au dossier web d'Apache
cd /var/www

# Cloner le projet
sudo git clone https://github.com/votre-repo/eec-centre-medical.git eec-site

# Donner les permissions
sudo chown -R www-data:www-data eec-site
sudo chmod -R 755 eec-site
sudo chmod -R 775 eec-site/writable
sudo chmod -R 775 eec-site/public
```

### Étape 7: Installer les Dépendances

```bash
cd /var/www/eec-site

# Installer via Composer (avec sudo car www-data)
sudo -u www-data composer install
```

### Étape 8: Configurer l'Environnement

```bash
# Copier le fichier .env
sudo cp .env.example .env

# Éditer avec nano (ou vim)
sudo nano .env
```

**Contenu `.env`:**
```ini
database.default.hostname = localhost
database.default.database = eecbafoussam
database.default.username = root
database.default.password = votre_mot_de_passe_mysql

app.baseURL = http://localhost/eec-site/
app.environment = development

email.protocol = smtp
email.SMTPHost = smtp.gmail.com
email.SMTPUser = votre-email@gmail.com
email.SMTPPass = votre-app-password
email.SMTPPort = 587
email.SMTPCrypto = tls
```

**Sauvegarder:** Ctrl+O, Entrée, Ctrl+X

### Étape 9: Créer la Base de Données

```bash
# Connecter à MySQL
mysql -u root -p

# Taper le mot de passe MySQL
```

Une fois connecté, exécuter:

```sql
CREATE DATABASE eecbafoussam CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Étape 10: Importer les Tables

```bash
# Importer les tables depuis le fichier SQL
mysql -u root -p eecbafoussam < /var/www/eec-site/eecbafoussam.sql
```

Taper le mot de passe MySQL quand demandé.

### Étape 11: Créer un VirtualHost Apache (Optionnel)

```bash
# Créer le fichier de configuration
sudo nano /etc/apache2/sites-available/eec-site.conf
```

**Contenu:**
```apache
<VirtualHost *:80>
    ServerName eec-site.local
    ServerAlias www.eec-site.local
    DocumentRoot /var/www/eec-site/public

    <Directory /var/www/eec-site/public>
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteBase /
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^(.*)$ index.php/$1 [L]
        </IfModule>
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/eec-site-error.log
    CustomLog ${APACHE_LOG_DIR}/eec-site-access.log combined
</VirtualHost>
```

Sauvegarder: Ctrl+O, Entrée, Ctrl+X

```bash
# Activer le site
sudo a2ensite eec-site.conf

# Redémarrer Apache
sudo systemctl restart apache2

# Modifier /etc/hosts pour le domaine local
sudo nano /etc/hosts
# Ajouter: 127.0.0.1  eec-site.local
```

### Étape 12: Accéder au Site

Ouvrir le navigateur:
- **Via Apache:** http://localhost/eec-site/
- **Via VirtualHost:** http://eec-site.local/
- **Admin:** http://localhost/eec-site/admin
  - Email: `administrationeecc@dashboard.com`
  - Mot de passe: `bafoussameec2026@web`

### (ALTERNATIVE LINUX) Via PHP Spark

```bash
# Aller au dossier du projet
cd /var/www/eec-site

# Démarrer le serveur
php spark serve --host 0.0.0.0 --port 9000
```

Accéder à: http://localhost:9000/

✅ **INSTALLATION LINUX TERMINÉE!**

---

## 🗄️ CONFIGURATION BASE DE DONNÉES

### Structures des Tables Créées

Le fichier `eecbafoussam.sql` crée automatiquement:

```sql
1. users                  - Comptes patients
2. admin_users            - Comptes administrateurs
3. email_verifications    - Jetons de vérification d'email
4. appointments           - Rendez-vous médicaux
5. services               - Services médicaux disponibles
6. audit_logs             - Journaux d'activité
7. hospital_users         - Utilisateurs hôpital
8. password_resets        - Jetons de réinitialisation
```

### Détails des Colonnes

#### Table `users` (Patients)
```sql
- id: INT PRIMARY KEY AUTO_INCREMENT
- nom: VARCHAR(255) - Nom complet
- email: VARCHAR(255) UNIQUE - Email unique
- mot_de_passe: VARCHAR(255) - Mot de passe bcrypt
- telephone: VARCHAR(20)
- verification_token: VARCHAR(255)
- verified_at: DATETIME - Date de vérification
- created_at: TIMESTAMP
- updated_at: TIMESTAMP
```

#### Table `admin_users` (Administrateurs)
```sql
- id: INT PRIMARY KEY AUTO_INCREMENT
- email: VARCHAR(255) UNIQUE
- mot_de_passe: VARCHAR(255) - Hash bcrypt
- nom: VARCHAR(255)
- role: VARCHAR(50) - super_admin, admin, user
- actif: TINYINT(1) - 1=actif, 0=inactif
- created_at: TIMESTAMP
- updated_at: TIMESTAMP
```

#### Table `appointments` (Rendez-vous)
```sql
- id: INT PRIMARY KEY AUTO_INCREMENT
- patient_name: VARCHAR(255)
- patient_email: VARCHAR(255)
- patient_phone: VARCHAR(20)
- appointment_date: DATE
- appointment_time: TIME
- service: VARCHAR(255) - Service médical
- notes: TEXT - Motif de consultation
- status: VARCHAR(50) - pending, confirmed, cancelled, completed
- created_at: TIMESTAMP
```

#### Table `services` (Services Médicaux)
```sql
- id: INT PRIMARY KEY AUTO_INCREMENT
- name: VARCHAR(255) UNIQUE
- description: TEXT
- specialite: VARCHAR(255)
- icon: VARCHAR(100)
- created_at: TIMESTAMP
```

### Importer Manuellement (Si Nécessaire)

```bash
# Depuis le terminal
mysql -u root -p eecbafoussam < eecbafoussam.sql

# Depuis MySQL CLI
mysql -u root -p
USE eecbafoussam;
SOURCE /chemin/vers/eecbafoussam.sql;
```

### Vérifier les Tables

```bash
mysql -u root -p eecbafoussam -e "SHOW TABLES;"
```

Résultat attendu:
```
+------------------------+
| Tables_in_eecbafoussam  |
+------------------------+
| admin_users            |
| appointments           |
| audit_logs             |
| email_verifications    |
| hospital_users         |
| password_resets        |
| services               |
| users                  |
+------------------------+
```

---

## 📦 INSTALLATION DU PROJET

### Structure du Projet

```
eec-site/
├── app/
│   ├── Config/           - Configuration (Database, Email, etc)
│   ├── Controllers/      - Contrôleurs CodeIgniter
│   ├── Models/           - Modèles de base de données
│   ├── Services/         - Services (Email, etc)
│   └── Views/            - Templates HTML
├── public/
│   ├── index.php         - Point d'entrée
│   └── ASSETS/           - CSS, JS, images
├── writable/             - Fichiers temporaires (logs, cache, etc)
├── system/               - CodeIgniter Framework (READ-ONLY)
├── vendor/               - Dépendances Composer
├── .env                  - Variables d'environnement
├── composer.json         - Dépendances PHP
├── spark                 - CLI CodeIgniter
└── eecbafoussam.sql    - Dump base de données
```

### Droits d'Accès sur Linux

```bash
# Dossier public (serveur web peut lire)
chmod 755 public

# Dossier writable (serveur web peut écrire)
chmod 775 writable

# Fichier .env (secret)
chmod 600 .env
```

### Variables d'Environnement (.env)

Voir l'étape de configuration de chaque système ci-dessus.

---

## ▶️ DÉMARRAGE DU SERVEUR

### Option 1: Serveur de Développement CodeIgniter (RECOMMANDÉ POUR DÉVELOPPEMENT)

```bash
cd /chemin/vers/eec-site

# Port 9000
php spark serve --host localhost --port 9000

# Ou accessible depuis d'autres machines
php spark serve --host 0.0.0.0 --port 9000
```

### Option 2: Serveur Apache (PRODUCTION)

**Windows (WAMP):**
- Cliquer sur l'icône WAMP → devrait être verte
- Accéder à: http://localhost/eec-site/

**Linux:**
```bash
sudo systemctl start apache2
sudo systemctl status apache2
```

Accéder à: http://localhost/eec-site/

### Option 3: Serveur PHP Intégré (RAPIDE)

```bash
cd /chemin/vers/eec-site/public
php -S localhost:8000
```

Accéder à: http://localhost:8000/

---

## ✅ VÉRIFICATION INSTALLATION

### Checklist de Démarrage

```
[ ] PHP 8.1+ installé
    Commande: php --version

[ ] MySQL/MariaDB en cours d'exécution
    Commande: mysql -u root -p -e "SELECT 1;"

[ ] Composer installé
    Commande: composer --version

[ ] Dépendances PHP installées
    Dossier: vendor/ existe et contient des fichiers

[ ] Base de données créée
    Commande: mysql -u root -p -e "SHOW DATABASES;" | grep eecbafoussam

[ ] Tables importées
    Commande: mysql -u root -p eecbafoussam -e "SHOW TABLES;"

[ ] Fichier .env configuré
    Fichier: .env existe et contient les paramètres

[ ] Dossier writable accessible en écriture
    Linux: ls -l writable/ affiche drwxrwxr-x

[ ] Serveur démarré sans erreurs
    Commande: php spark serve
    Pas d'erreur dans la sortie
```

### Tests Fonctionnels

1. **Accueil** → http://localhost:9000/
   - ✅ Page charge correctement
   - ✅ Styles CSS appliqués
   - ✅ Images visibles

2. **Créer un compte** → http://localhost:9000/creer_un_compte
   - ✅ Formulaire affiche
   - ✅ Tous les champs présents

3. **Se connecter** → http://localhost:9000/sinscrire
   - ✅ Formulaire login visible

4. **Tableau de bord Admin** → http://localhost:9000/admin
   - ✅ Page de connexion charge
   - ✅ Accepte les identifiants fournis

5. **Contact** → http://localhost:9000/Contact
   - ✅ Formulaire visible
   - ✅ Champs corrects

6. **Services** → http://localhost:9000/service_medicaux
   - ✅ Services affichés
   - ✅ Images visibles

---

## 🔧 DÉPANNAGE

### "Impossible de se connecter à la base de données"

```bash
# Vérifier que MySQL/MariaDB est en cours d'exécution

# Windows (WAMP)
# L'icône doit être verte

# Linux
sudo systemctl status mariadb

# Vérifier les identifiants dans .env
# database.default.hostname = localhost
# database.default.username = root
# database.default.password = YOUR_PASSWORD
# database.default.database = eecbafoussam

# Tester la connexion
mysql -u root -p -h localhost eecbafoussam -e "SELECT 1;"
```

### "Erreur 404 - Page non trouvée"

```bash
# Vérifier que le fichier existe
ls -la app/Views/acceuil.php

# Sur Linux, vérifier mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2

# Vérifier app.baseURL dans .env
# Doit correspondre à votre URL
```

### "Erreur 500 - Erreur serveur interne"

```bash
# Vérifier les logs
tail -50 writable/logs/log-*.log

# Vérifier les permissions writable/
chmod -R 775 writable/

# Vérifier la configuration .env
cat .env | grep database
```

### "Composer install échoue"

```bash
# Vérifier PHP
php --version  # Doit être 8.1+

# Mettre à jour Composer
composer self-update

# Réessayer
composer install --verbose
```

### "Emails ne s'envoient pas"

```bash
# Vérifier .env pour SMTP
cat .env | grep email

# Vérifier les logs d'erreur
tail -50 writable/logs/log-*.log | grep -i email

# Pour Gmail, créer un App Password:
# https://myaccount.google.com/apppasswords
```

### "Impossible d'écrire dans le dossier writable"

```bash
# Linux: Donner les permissions
sudo chmod -R 775 writable/
sudo chown -R www-data:www-data writable/

# Windows: Propriétés → Sécurité → Modifier permissions
```

### "Page blanche ou erreur CSS/JS"

```bash
# Vérifier l'URL de base dans .env
# app.baseURL = http://localhost:9000/

# Vérifier que public/ASSETS/ existe
ls -la public/ASSETS/

# Vider le cache CodeIgniter
rm -rf writable/cache/*
```

---

## 📞 SUPPORT

**Erreurs courantes?** Consultez la section [Dépannage](#dépannage)

**Besoin d'aide?**
1. Vérifier les logs: `writable/logs/`
2. Relire cette documentation
3. Vérifier la configuration `.env`

---

## ✨ PROCHAINES ÉTAPES

Une fois installé:

1. **Configurer le domaine** (si en production)
   - DNS settings
   - SSL certificate
   - Email notifications

2. **Personnaliser le contenu**
   - Services médicaux
   - Informations de contact
   - Images et logo

3. **Configurer email notifications**
   - Gmail App Password
   - Email templates
   - Confirmations d'inscription

4. **Tester complètement**
   - Créer des comptes
   - Prendre des rendez-vous
   - Vérifier les emails

5. **Sauvegarder régulièrement**
   - Base de données
   - Fichiers du projet
   - Configurations

---

## 📋 INFORMATION SYSTÈME

```
Framework:      CodeIgniter 4.6.1
PHP Minimum:    8.1
Database:       MySQL 5.7+ / MariaDB 10.3+
Cache System:   File-based
Session:        File-based
Email:          Gmail SMTP
```

**Good luck! 🚀**
