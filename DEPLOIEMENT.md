# 🚀 GUIDE DE DÉPLOIEMENT COMPLET - EEC CENTRE MÉDICAL

**Version:** 1.0 Production  
**Date:** 13 janvier 2026  
**Compétence Requise:** Intermédiaire en administration serveur  
**Durée Estimée:** 20-30 minutes  

---

## 📋 TABLE DES MATIÈRES

1. [Préparation](#préparation)
2. [Déploiement Complet de la Base de Données](#déploiement-complet-de-la-base-de-données)
3. [Déploiement du Projet](#déploiement-du-projet)
4. [Vérification Post-Déploiement](#vérification-post-déploiement)
5. [Dépannage](#dépannage)

---

## 🔧 PRÉPARATION

### Vérifier les Prérequis

Avant de commencer, assurez-vous que vous avez:

```bash
# 1. Vérifier PHP 8.1+
php --version
# Résultat attendu: PHP 8.1.0 ou supérieur

# 2. Vérifier MySQL/MariaDB
mysql --version
# Résultat attendu: mysql Ver 8.0+ ou MariaDB 10.3+

# 3. Vérifier Composer
composer --version
# Résultat attendu: Composer version 2.x

# 4. Vérifier Git
git --version
# Résultat attendu: git version 2.x
```

**Si l'une de ces vérifications échoue**, consultez [INSTALLATION.md](INSTALLATION.md).

### Localiser les Fichiers Critiques

Avant le déploiement, localisez ces fichiers essentiels:

```
eecbafoussam.sql          ← Fichier SQL complet (BASE DE DONNÉES)
.env                      ← Fichier de configuration
DEPLOIEMENT.md           ← Ce guide
INSTALLATION.md          ← Installation détaillée
SYSTEME.md              ← Documentation système
```

---

## 🗄️ DÉPLOIEMENT COMPLET DE LA BASE DE DONNÉES

### MÉTHODE 1: Déploiement Automatique (RECOMMANDÉ)

**Une seule commande pour tout:**

```bash
# Option 1: Avec mot de passe en paramètre (MOINS SÉCURISÉ)
mysql -u root -p"votre_mot_de_passe_mysql" < eecbafoussam.sql

# Option 2: Avec mot de passe interactif (PLUS SÉCURISÉ - RECOMMANDÉ)
mysql -u root -p < eecbafoussam.sql
# Puis taper votre mot de passe MySQL quand demandé
```

**Attendez la sortie:**
```
Query OK, 1 row affected (0.XX sec)
Query OK, 15 rows affected (0.XX sec)
...
```

### MÉTHODE 2: Déploiement Manuel Étape par Étape

**Pour les débutants ou debug:**

```bash
# 1. Connecter à MySQL
mysql -u root -p
# Entrer votre mot de passe MySQL

# 2. Dans le prompt MySQL, exécuter:
SOURCE /chemin/complet/vers/eecbafoussam.sql;

# Exemple Windows:
SOURCE C:\Users\VotreNom\Desktop\eecbafoussam.sql;

# Exemple Linux:
SOURCE /home/utilisateur/EEC-SITE-WEB/eecbafoussam.sql;
```

### MÉTHODE 3: Via phpMyAdmin (Pour GUI)

**Si vous préférez l'interface graphique:**

1. Ouvrir phpMyAdmin: `http://localhost/phpmyadmin/`
2. Cliquer sur l'onglet **"Importer"**
3. Cliquer sur **"Choisir un fichier"**
4. Sélectionner: `eecbafoussam.sql`
5. Cliquer sur **"Exécuter"**
6. Attendre le succès ✅

---

## ✅ VÉRIFICATION DE LA BASE DE DONNÉES

### Vérifier que Tout est Créé

```bash
# 1. Connecter à MySQL
mysql -u root -p

# 2. Vérifier que la base existe
SHOW DATABASES;
# Vous devez voir: eecbafoussam

# 3. Utiliser la base
USE eecbafoussam;

# 4. Afficher les tables
SHOW TABLES;
```

**Résultat attendu (9 tables):**
```
+-----------------------+
| Tables_in_eecbafoussam|
+-----------------------+
| admin_users           |
| appointments          |
| audit_logs            |
| contacts              |
| email_verifications   |
| login                 |
| password_resets       |
| services              |
| visitors              |
+-----------------------+
```

### Vérifier les Services

```bash
mysql -u root -p eecbafoussam -e "SELECT id, name, specialite FROM services ORDER BY id;"
```

**Résultat attendu (15 services):**
```
+----+-------------------------------------+-------------------+
| id | name                                | specialite        |
+----+-------------------------------------+-------------------+
|  1 | Consultation générale               | Médecine générale |
|  2 | Pédiatrie/Néonatologie              | Pédiatrie         |
|  3 | Obstétrique/Gynécologie             | Gynécologie       |
|  4 | Chirurgie générale                  | Chirurgie         |
|  5 | Médecine interne                    | Médecine interne  |
|  6 | Neurologie                          | Neurologie        |
|  7 | Réanimation                         | Réanimation       |
|  8 | Kinésithérapie                      | Kinésithérapie    |
|  9 | Nutrition                           | Nutrition         |
| 10 | Cardiologie                         | Cardiologie       |
| 11 | Dermatologie                        | Dermatologie      |
| 12 | Ophtalmologie                       | Ophtalmologie     |
| 13 | ORL (Oto-Rhino-Laryngologie)       | ORL               |
| 14 | Urologie                            | Urologie          |
| 15 | Orthopédie                          | Orthopédie        |
+----+-------------------------------------+-------------------+
```

### Vérifier l'Admin Créé

```bash
mysql -u root -p eecbafoussam -e "SELECT id_admin, email, nom, role FROM admin_users;"
```

**Résultat attendu:**
```
+---------+-------------------------------------+---------------------------+------------+
| id_admin| email                               | nom                       | role       |
+---------+-------------------------------------+---------------------------+------------+
| 1       | administrationeecc@dashboard.com    | Administrateur EEC Bafoussam | super_admin|
+---------+-------------------------------------+---------------------------+------------+
```

---

## 📦 DÉPLOIEMENT DU PROJET

### Étape 1: Cloner le Projet

```bash
# Aller au dossier approprié
# Windows WAMP:
cd C:\wamp64\www

# Linux Apache:
cd /var/www

# Cloner le projet
git clone <votre-repo> eec-site
cd eec-site
```

### Étape 2: Installer les Dépendances

```bash
# Installer les dépendances Composer
composer install

# Vérifier que vendor/ est créé
ls vendor/
# Ou sur Windows: dir vendor\
```

### Étape 3: Configurer l'Environnement

```bash
# Copier le fichier .env
# Windows:
copy .env.example .env

# Linux:
cp .env.example .env

# Éditer avec votre éditeur préféré
nano .env        # Linux
notepad++ .env   # Windows
```

**Vérifier et ajuster ces paramètres essentiels:**

```ini
# DATABASE CONFIGURATION
database.default.hostname = localhost
database.default.database = eecbafoussam
database.default.username = root
database.default.password = YOUR_MYSQL_PASSWORD
database.default.port = 3306
database.default.DBDriver = MySQLi

# APPLICATION
app.baseURL = http://localhost:9000/
app.environment = development
CI_ENVIRONMENT = development

# SECURITY
encryption.key = random32charstring  # Générer une clé sécurisée
app.CSRFProtection = true
app.CSRFTokenName = csrf_token_name
app.CSRFCookieName = csrf_cookie_name
app.CSRFExpire = 7200

# SESSION
session.driver = FileHandler
session.cookieName = PHPSESSID
session.expiration = 7200

# EMAIL (Gmail SMTP)
email.protocol = smtp
email.SMTPHost = smtp.gmail.com
email.SMTPUser = votre-email@gmail.com
email.SMTPPass = votre-app-password
email.SMTPPort = 587
email.SMTPCrypto = tls
email.fromEmail = noreply@eeccentremedical.com
email.fromName = EEC Centre Médical
```

### Étape 4: Configurer les Permissions (Linux)

```bash
# Dossier public
chmod 755 public

# Dossier writable (logs, cache, uploads)
chmod 775 writable
chmod 775 writable/cache
chmod 775 writable/logs
chmod 775 writable/session
chmod 775 writable/uploads

# Propriétaire
sudo chown -R www-data:www-data .
```

### Étape 5: Démarrer le Serveur

**Option A: Serveur de Développement (CodeIgniter Spark) - RECOMMANDÉ**

```bash
# Port 9000 - Accessible en local uniquement
php spark serve --host localhost --port 9000

# Port 9000 - Accessible depuis d'autres machines
php spark serve --host 0.0.0.0 --port 9000
```

**Option B: Serveur Apache (Production)**

```bash
# Windows WAMP
# L'icône WAMP doit être verte

# Linux
sudo systemctl start apache2
sudo systemctl status apache2
```

---

## 🔍 VÉRIFICATION POST-DÉPLOIEMENT

### Checklist de Vérification

```
✅ PRÉREQUIS
[ ] PHP 8.1+ installé
[ ] MySQL/MariaDB en cours d'exécution
[ ] Composer installé

✅ BASE DE DONNÉES
[ ] Base eecbafoussam créée
[ ] 9 tables créées (login, admin_users, etc.)
[ ] 15 services insérés
[ ] Admin créé avec email administrationeecc@dashboard.com

✅ PROJET
[ ] Dossier vendor/ existe
[ ] Fichier .env configuré correctement
[ ] Dossier writable accessible en écriture
[ ] Permissions correctes sur Linux

✅ SERVEUR
[ ] Serveur démarre sans erreur
[ ] Pas de message d'erreur en console
[ ] Application accessible
```

### Tests Fonctionnels

**1. Accueil du site**
```
URL: http://localhost:9000/
Résultat attendu:
  ✅ Page charge correctement
  ✅ CSS appliqué (couleurs, layout)
  ✅ Images visibles
  ✅ Navigation fonctionnelle
```

**2. Créer un compte**
```
URL: http://localhost:9000/creer_un_compte
Résultat attendu:
  ✅ Formulaire affiche
  ✅ Tous les champs présents (nom, email, téléphone, mot de passe)
  ✅ Validation côté client fonctionne
  ✅ Enregistrement réussit
```

**3. Se connecter**
```
URL: http://localhost:9000/sinscrire
Résultat attendu:
  ✅ Formulaire login visible
  ✅ Identifiants acceptés
  ✅ Redirection vers profil après connexion
```

**4. Tableau de Bord Admin**
```
URL: http://localhost:9000/admin
Email: administrationeecc@dashboard.com
Mot de passe: bafoussameec2026@web

Résultat attendu:
  ✅ Page de connexion charge
  ✅ Identifiants acceptés ✅
  ✅ Tableau de bord affiche
  ✅ Accès à la gestion des rendez-vous
  ✅ Accès aux statistiques
```

**5. Services Médicaux**
```
URL: http://localhost:9000/service_medicaux
Résultat attendu:
  ✅ 15 services affichés
  ✅ Descriptions visibles
  ✅ Icônes affichées
  ✅ Recherche par spécialité fonctionne
```

**6. Rendez-vous**
```
URL: http://localhost:9000/appointment
Résultat attendu:
  ✅ Formulaire affiche
  ✅ Sélection de service fonctionne
  ✅ Sélection de date/heure fonctionne
  ✅ Enregistrement réussit
```

**7. Contact**
```
URL: http://localhost:9000/Contact
Résultat attendu:
  ✅ Formulaire affiche
  ✅ Tous les champs présents
  ✅ Validation fonctionne
  ✅ Email envoyé
```

### Vérification en Terminal

```bash
# 1. Vérifier la connexion à la base
mysql -u root -p -h localhost eecbafoussam -e "SELECT 1;"

# 2. Vérifier les logs
tail -50 writable/logs/log-*.log

# 3. Vérifier les erreurs PHP
tail -50 writable/logs/error-*.log

# 4. Vérifier les services
mysql -u root -p eecbafoussam -e "SELECT COUNT(*) as total_services FROM services;"
# Résultat: 15
```

---

## 🔧 DÉPANNAGE

### "Erreur: Base de données introuvable"

```bash
# Vérifier que la base existe
mysql -u root -p -e "SHOW DATABASES;" | grep eecbafoussam

# Si pas trouvé, redéployer:
mysql -u root -p < eecbafoussam.sql

# Vérifier les identifiants dans .env
cat .env | grep database
```

### "Erreur: 500 Internal Server Error"

```bash
# 1. Vérifier les logs
tail -100 writable/logs/log-*.log

# 2. Vérifier permissions writable/
chmod -R 775 writable/

# 3. Vérifier .env
cat .env | grep "^[^#]" | head -20

# 4. Vider le cache
rm -rf writable/cache/*
rm -rf writable/logs/*
```

### "Erreur: 404 Page Non Trouvée"

```bash
# 1. Vérifier que les routes existent
cat app/Config/Routes.php | grep "appointment\|service\|login"

# 2. Vérifier app.baseURL
cat .env | grep "app.baseURL"

# 3. Linux: Vérifier mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### "Impossible de se connecter comme admin"

```bash
# 1. Vérifier que l'admin existe
mysql -u root -p eecbafoussam -e \
  "SELECT email, nom FROM admin_users WHERE email='administrationeecc@dashboard.com';"

# 2. Vérifier la base de données
mysql -u root -p eecbafoussam -e "SHOW TABLES;"

# 3. Redéployer si nécessaire
mysql -u root -p < eecbafoussam.sql
```

### "Services ne s'affichent pas"

```bash
# Vérifier que les services sont insérés
mysql -u root -p eecbafoussam -e "SELECT COUNT(*) FROM services;"
# Résultat attendu: 15

# Si vide, insérer manuellement:
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

### "Erreur de mail (SMTP)"

```bash
# Vérifier la configuration .env
cat .env | grep email

# Tester la connexion SMTP
# Utiliser: https://mxtoolbox.com/smtp.aspx

# Pour Gmail:
# 1. Créer un App Password: https://myaccount.google.com/apppasswords
# 2. Utiliser cet App Password dans email.SMTPPass
# 3. Activer "Moins sécurisé": https://myaccount.google.com/security

# Vérifier les logs
grep -i "smtp\|mail" writable/logs/log-*.log
```

---

## 📊 STRUCTURE DE LA BASE DE DONNÉES

### Vue d'ensemble des 9 Tables

```
┌─────────────────────────────────────────────────────────────┐
│                    EECBAFOUSSAM Database                    │
├─────────────────────────────────────────────────────────────┤
│
├─ 1. login (Patients)
│    ├─ idlogin (PK)
│    ├─ name_surName
│    ├─ email (UNIQUE)
│    ├─ telephone
│    ├─ mot_de_passe (bcrypt)
│    ├─ Date-creation
│    ├─ actif
│    └─ email_verified
│
├─ 2. admin_users (Administrateurs)
│    ├─ id_admin (PK)
│    ├─ email (UNIQUE)
│    ├─ mot_de_passe (bcrypt)
│    ├─ nom
│    ├─ role (super_admin, admin, moderator)
│    ├─ actif
│    └─ date_creation
│
├─ 3. services (15 Services Médicaux)
│    ├─ id (PK)
│    ├─ name (UNIQUE)
│    ├─ description
│    ├─ specialite
│    ├─ icon
│    ├─ is_active
│    └─ ordre_affichage
│
├─ 4. appointments (Rendez-vous)
│    ├─ id_appointment (PK)
│    ├─ idlogin (FK → login)
│    ├─ name_surName
│    ├─ email
│    ├─ date_appointment
│    ├─ raison
│    ├─ service
│    ├─ status (pending, confirmed, cancelled, completed)
│    └─ date_creation
│
├─ 5. email_verifications (Tokens Email)
│    ├─ id_verification (PK)
│    ├─ email
│    ├─ token (UNIQUE)
│    ├─ verified (bool)
│    ├─ expires_at
│    └─ created_at
│
├─ 6. audit_logs (Sécurité & Audit)
│    ├─ id_log (PK)
│    ├─ user_id
│    ├─ action
│    ├─ entity_type
│    ├─ ip_address
│    ├─ status (success, failure)
│    └─ timestamp
│
├─ 7. visitors (Analytics)
│    ├─ id_visitor (PK)
│    ├─ idlogin (FK → login)
│    ├─ email
│    ├─ visitor_type
│    ├─ date_visit
│    └─ ip_address
│
├─ 8. contacts (Messages)
│    ├─ id_contact (PK)
│    ├─ nom, email, telephone
│    ├─ sujet, message
│    ├─ statut (nouveau, en_lecture, repondu, archive)
│    └─ date_creation
│
└─ 9. password_resets (Réinitialisation Mot de Passe)
     ├─ id_reset (PK)
     ├─ email
     ├─ token (UNIQUE)
     ├─ expires_at
     └─ created_at
```

---

## 🔐 SÉCURITÉ

### Points de Sécurité Implémentés

✅ **Mot de passe:** Hashage bcrypt (coût 10)  
✅ **CSRF:** Protection CSRF activée  
✅ **SQL Injection:** Prepared statements + Parameterized queries  
✅ **Audit:** Logs complets de toutes les actions  
✅ **Données:** utf8mb4_unicode_ci (support complet Unicode)  
✅ **Email:** Vérification d'email avec tokens  
✅ **Administrateur:** Rôles basés (super_admin, admin, moderator)  

### Bonnes Pratiques

```bash
# 1. Changer le mot de passe root MySQL
mysql -u root -p
ALTER USER 'root'@'localhost' IDENTIFIED BY 'nouveau_mot_de_passe';
FLUSH PRIVILEGES;

# 2. Créer un utilisateur dédié (optionnel mais recommandé)
CREATE USER 'eecuser'@'localhost' IDENTIFIED BY 'mot_de_passe_fort';
GRANT ALL PRIVILEGES ON eecbafoussam.* TO 'eecuser'@'localhost';
FLUSH PRIVILEGES;

# 3. Générer une clé de chiffrement sécurisée
php -r "echo base64_encode(random_bytes(32));"
# Copier la sortie dans .env → encryption.key

# 4. Changer le mot de passe admin après déploiement
# Via la page d'administration
```

---

## 📋 INFORMATIONS SYSTÈME FINALES

```
Nom de la base:        eecbafoussam
Collation:             utf8mb4_unicode_ci
Tables:                9 (login, admin_users, services, appointments, etc.)
Services préchargés:   15 (Consultation, Pédiatrie, Gynécologie, etc.)
Admin compte:          administrationeecc@dashboard.com / bafoussameec2026@web
Framework:             CodeIgniter 4.6.1
PHP Minimum:           8.1.0
Database Engine:       InnoDB
Indices:               Optimisés pour performance
Clés étrangères:       Configurées et actives
Audit Trail:           Complet avec IP, User Agent, Timestamps
```

---

## ✨ PROCHAINES ÉTAPES

Une fois le déploiement complété:

1. **Tester complètement**
   - Créer des comptes patients
   - Prendre des rendez-vous
   - Tester l'admin dashboard
   - Vérifier les emails

2. **Personnaliser le contenu**
   - Ajouter logo/images
   - Modifier les textes
   - Ajouter les adresses de contact

3. **Configurer les emails**
   - Gmail App Password
   - Domaine personnalisé
   - Templates d'email

4. **Sauvegarde et maintenance**
   - Sauvegarde quotidienne de la BD
   - Monitoring des logs
   - Mise à jour de sécurité

5. **Mettre en production**
   - Obtenir un domaine
   - Certificat SSL
   - Configuration serveur final

---

## 📞 SUPPORT

**Erreur pendant le déploiement?**

1. Consulter la section [Dépannage](#dépannage)
2. Vérifier les logs: `writable/logs/`
3. Relire cette documentation
4. Vérifier que tous les prérequis sont installés

**Documentation complémentaire:**
- [INSTALLATION.md](INSTALLATION.md) - Installation détaillée
- [SYSTEME.md](SYSTEME.md) - Architecture et système
- [BASE_DE_DONNEES.md](BASE_DE_DONNEES.md) - Commandes SQL avancées
- [README.md](README.md) - Démarrage rapide

---

**Déploiement réussi! 🎉**

Le système est maintenant prêt pour **PRODUCTION**.

Vous pouvez accéder à:
- **Site:** http://localhost:9000/
- **Admin:** http://localhost:9000/admin (administrationeecc@dashboard.com / bafoussameec2026@web)

---

**Statut: ✅ PRODUCTION READY**
