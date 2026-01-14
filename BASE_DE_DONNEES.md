# 📊 GUIDE COMPLET SQL - BASE DE DONNÉES EEC CENTRE MÉDICAL

**Version:** 1.0  
**Dernière mise à jour:** January 13, 2026

---

## 📋 TABLE DES MATIÈRES

1. [Charger la Base Complète](#charger-la-base-complète)
2. [Créer les Tables Individuellement](#créer-les-tables-individuellement)
3. [Insérer les Données](#insérer-les-données)
4. [Vérifier l'Installation](#vérifier-linstallation)
5. [Commandes Utiles](#commandes-utiles)
6. [Problèmes Courants](#problèmes-courants)

---

## 🚀 CHARGER LA BASE COMPLÈTE

### Option 1: Via Fichier SQL (RECOMMANDÉ)

C'est la méthode la plus facile et rapide qui crée TOUT en une seule commande.

#### Sur Windows (WAMP/Command Prompt)

```cmd
cd C:\wamp64\www\eec-site

# Charger le dump complet
mysql -u root -p eecbafoussam < eecbafoussam.sql

# Vous serez invité à entrer le mot de passe MySQL
```

#### Sur Linux (Terminal)

```bash
cd /var/www/eec-site

# Charger le dump complet
mysql -u root -p eecbafoussam < eecbafoussam.sql

# Ou si le mot de passe est vide:
mysql -u root eecbafoussam < eecbafoussam.sql
```

#### Via phpMyAdmin

1. Ouvrir phpMyAdmin
   - Windows: Cliquer sur WAMP (vert) → phpMyAdmin
   - Linux: http://localhost/phpmyadmin
   - URL: http://localhost/phpmyadmin

2. Sélectionner la base `eecbafoussam`

3. Onglet "Importer" (Import tab)

4. Cliquer "Parcourir" (Browse)
   - Sélectionner: `eecbafoussam.sql`

5. Cliquer "Exécuter" (Go)

6. Attendre le message de succès ✅

---

### Option 2: Via CLI MySQL (Manuel)

Si le fichier SQL n'existe pas, créer les tables manuellement:

```bash
mysql -u root -p
# Entrer le mot de passe MySQL

# Une fois connecté à MySQL:
USE eecbafoussam;
```

Ensuite, exécuter les commandes ci-dessous selon l'ordre.

---

## 🗄️ CRÉER LES TABLES INDIVIDUELLEMENT

### 1️⃣ Table: `users` (Comptes Patients)

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `verification_token` (`verification_token`),
  KEY `idx_verified` (`verified_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 2️⃣ Table: `admin_users` (Comptes Administrateurs)

```sql
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `actif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_actif` (`actif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 3️⃣ Table: `appointments` (Rendez-vous Médicaux)

```sql
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_patient_email` (`patient_email`),
  KEY `idx_appointment_date` (`appointment_date`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 4️⃣ Table: `services` (Services Médicaux)

```sql
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 5️⃣ Table: `email_verifications` (Tokens de Vérification)

```sql
CREATE TABLE `email_verifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `idx_email` (`email`),
  KEY `idx_verified_at` (`verified_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 6️⃣ Table: `password_resets` (Réinitialisation Mot de Passe)

```sql
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 7️⃣ Table: `audit_logs` (Journal d'Activité)

```sql
CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 8️⃣ Table: `hospital_users` (Utilisateurs Hôpital)

```sql
CREATE TABLE `hospital_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 📝 INSÉRER LES DONNÉES

### Insérer l'Administrateur par Défaut

```sql
-- Créer l'account admin par défaut
-- Email: administrationeecc@dashboard.com
-- Mot de passe: bafoussameec2026@web (hash bcrypt)

INSERT INTO `admin_users` (
  `email`,
  `mot_de_passe`,
  `nom`,
  `role`,
  `actif`
) VALUES (
  'administrationeecc@dashboard.com',
  '$2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
  'Administrateur EEC',
  'super_admin',
  1
);
```

**Note:** Le mot de passe est déjà inseré dans le dump `eecbafoussam.sql`

---

### Insérer les Services Médicaux (15 Services)

```sql
INSERT INTO `services` (
  `name`,
  `description`,
  `specialite`,
  `icon`
) VALUES
  ('Cardiologie', 'Traitement des maladies du cœur et du système cardiovasculaire', 'Cardiologie', 'fa-heart'),
  ('Neurologie', 'Diagnostic et traitement des maladies du système nerveux', 'Neurologie', 'fa-brain'),
  ('Pédiatrie', 'Soins et traitement des enfants', 'Pédiatrie', 'fa-baby'),
  ('Orthopédie', 'Traitement des problèmes des os et articulations', 'Orthopédie', 'fa-bone'),
  ('Dermatologie', 'Traitement des maladies de la peau', 'Dermatologie', 'fa-user-md'),
  ('Ophtalmologie', 'Soins des yeux et troubles de la vision', 'Ophtalmologie', 'fa-eye'),
  ('ORL', 'Traitement des oreilles, nez et gorge', 'ORL', 'fa-ear'),
  ('Gastroentérologie', 'Traitement des maladies digestives', 'Gastroentérologie', 'fa-stomach'),
  ('Pneumologie', 'Traitement des maladies respiratoires', 'Pneumologie', 'fa-lungs'),
  ('Urologie', 'Traitement des voies urinaires', 'Urologie', 'fa-kidney'),
  ('Gynécologie', 'Santé et maladies de la femme', 'Gynécologie', 'fa-venus'),
  ('Chirurgie Générale', 'Interventions chirurgicales générales', 'Chirurgie', 'fa-scalpel'),
  ('Radiologie', 'Imagerie médicale et diagnostics par rayons X', 'Radiologie', 'fa-x-ray'),
  ('Laboratoire', 'Analyses biologiques et tests sanguins', 'Laboratoire', 'fa-flask'),
  ('Pharmacie', 'Délivrance et conseil sur les médicaments', 'Pharmacie', 'fa-pills');
```

---

### Insérer des Utilisateurs de Test

```sql
-- Créer un utilisateur de test (patient)
-- Email: patient@test.com
-- Mot de passe: password123 (bcrypt hash)

INSERT INTO `users` (
  `nom`,
  `email`,
  `mot_de_passe`,
  `telephone`,
  `verified_at`
) VALUES (
  'Jean Dupont',
  'patient@test.com',
  '$2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
  '+33612345678',
  NOW()
);
```

---

## ✅ VÉRIFIER L'INSTALLATION

### Vérifier les Bases de Données

```sql
-- Afficher toutes les bases
SHOW DATABASES;
```

**Vous devez voir:** `eecbafoussam` dans la liste

---

### Vérifier les Tables

```sql
-- Utiliser la base eecbafoussam
USE eecbafoussam;

-- Afficher toutes les tables
SHOW TABLES;
```

**Résultat attendu:**
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
8 rows in set
```

---

### Vérifier la Structure d'une Table

```sql
-- Afficher la structure de la table users
DESCRIBE users;

-- Ou (syntaxe alternative)
SHOW COLUMNS FROM users;
```

**Vous devez voir:** id, nom, email, mot_de_passe, telephone, etc.

---

### Vérifier les Données Insérées

```sql
-- Compter les administrateurs
SELECT COUNT(*) as nb_admins FROM admin_users;
-- Résultat: 1 (l'admin par défaut)

-- Compter les services
SELECT COUNT(*) as nb_services FROM services;
-- Résultat: 15 (les 15 services médicaux)

-- Lister tous les services
SELECT id, name, specialite FROM services;

-- Afficher l'admin
SELECT email, nom, role FROM admin_users;

-- Compter les rendez-vous
SELECT COUNT(*) as nb_appointments FROM appointments;
```

---

### Vérifier les Index

```sql
-- Afficher les index de la table users
SHOW INDEX FROM users;

-- Afficher les index de la table appointments
SHOW INDEX FROM appointments;
```

---

## 🔧 COMMANDES UTILES

### Sauvegarde de la Base de Données

```bash
# Export complet
mysqldump -u root -p eecbafoussam > eec_backup_$(date +%Y%m%d_%H%M%S).sql

# Export sans le mot de passe (si vide)
mysqldump -u root eecbafoussam > eec_backup.sql

# Export en même temps que vous posez le mot de passe
mysqldump -u root -p eecbafoussam > backup.sql < passfile.txt
```

---

### Restaurer une Sauvegarde

```bash
# Restaurer une sauvegarde
mysql -u root -p eecbafoussam < eec_backup.sql

# Ou via MySQL CLI
mysql -u root -p
USE eecbafoussam;
SOURCE /chemin/vers/eec_backup.sql;
```

---

### Supprimer et Recréer la Base

```bash
# ⚠️ ATTENTION: Cela supprime TOUTES les données!
mysql -u root -p -e "DROP DATABASE eecbafoussam;"
mysql -u root -p -e "CREATE DATABASE eecbafoussam CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Puis réimporter:
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

---

### Vider une Table (Garder la Structure)

```sql
-- Supprimer tous les données mais garder la table
TRUNCATE TABLE appointments;

-- Réinitialiser l'auto-increment
ALTER TABLE appointments AUTO_INCREMENT = 1;
```

---

### Ajouter un Nouvel Administrateur

```sql
-- Créer le mot de passe bcrypt (PHP):
-- password_hash('MonMotDePasse', PASSWORD_DEFAULT)
-- Exemple: $2y$10$abc123...

INSERT INTO `admin_users` (
  `email`,
  `mot_de_passe`,
  `nom`,
  `role`,
  `actif`
) VALUES (
  'nouvel.admin@example.com',
  '$2y$10$abc123def456...',
  'Nouvel Administrateur',
  'admin',
  1
);
```

---

### Désactiver un Administrateur

```sql
-- Désactiver un compte admin sans le supprimer
UPDATE admin_users SET actif = 0 WHERE email = 'admin@example.com';

-- Réactiver
UPDATE admin_users SET actif = 1 WHERE email = 'admin@example.com';
```

---

### Réinitialiser le Mot de Passe Admin

```sql
-- Utiliser le bcrypt hash du nouveau mot de passe
UPDATE admin_users 
SET mot_de_passe = '$2y$10$new_bcrypt_hash_here'
WHERE email = 'admin@example.com';
```

---

### Afficher les Statistiques

```sql
-- Nombre total de rendez-vous
SELECT COUNT(*) as total FROM appointments;

-- Rendez-vous par service
SELECT service, COUNT(*) as nombre 
FROM appointments 
GROUP BY service 
ORDER BY nombre DESC;

-- Rendez-vous par status
SELECT status, COUNT(*) as nombre 
FROM appointments 
GROUP BY status;

-- Rendez-vous d'aujourd'hui
SELECT * FROM appointments 
WHERE DATE(appointment_date) = CURDATE();

-- Rendez-vous futurs
SELECT * FROM appointments 
WHERE appointment_date >= CURDATE() 
ORDER BY appointment_date ASC;
```

---

## ⚠️ PROBLÈMES COURANTS

### "Access denied for user 'root'@'localhost'"

```bash
# Le mot de passe est incorrect ou manquant

# Essayer sans mot de passe
mysql -u root eecbafoussam

# Essayer avec un mot de passe spécifique
mysql -u root -p'YOUR_PASSWORD' eecbafoussam
# (sans espace après -p)

# Ou avec espace:
mysql -u root --password=YOUR_PASSWORD eecbafoussam
```

---

### "Unknown database 'eecbafoussam'"

```bash
# La base de données n'existe pas

# Créer d'abord la base
mysql -u root -p -e "CREATE DATABASE eecbafoussam CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Puis importer les tables
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

---

### "Table 'eecbafoussam.users' doesn't exist"

```bash
# Les tables ne sont pas créées

# Vérifier quelles tables existent
mysql -u root -p eecbafoussam -e "SHOW TABLES;"

# Si aucune, importer le fichier SQL
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

---

### "Duplicate entry ... for key 'email'"

```sql
-- Vous essayez d'insérer un email qui existe déjà

-- Vérifier les emails existants
SELECT email FROM users;
SELECT email FROM admin_users;

-- Utiliser un email unique
INSERT INTO users (nom, email, mot_de_passe) 
VALUES ('Jean', 'jean.nouveau@example.com', '$2y$10$...');
```

---

### "Syntax error near 'CHARACTER SET'"

```bash
# Votre version de MySQL est trop vieille

# Utiliser une syntaxe compatible:
CREATE DATABASE eecbafoussam;
ALTER DATABASE eecbafoussam CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## 📊 RÉSUMÉ DES TABLES

| Table | Rows | Columns | Purpose |
|-------|------|---------|---------|
| users | Variable | 9 | Comptes patients |
| admin_users | 1+ | 8 | Comptes administrateurs |
| appointments | Variable | 10 | Rendez-vous médicaux |
| services | 15 | 6 | Services médicaux |
| email_verifications | Variable | 7 | Tokens vérification email |
| password_resets | Variable | 5 | Tokens reset mot de passe |
| audit_logs | Variable | 7 | Journal d'activité |
| hospital_users | Variable | 5 | Utilisateurs hôpital |

---

## ✨ RÉSUMÉ COMMANDES ESSENTIELLES

```bash
# === CHARGER LA BASE (LA SEULE COMMANDE QUE VOUS AVEZ BESOIN!) ===
mysql -u root -p eecbafoussam < eecbafoussam.sql

# === VÉRIFIER ===
mysql -u root -p eecbafoussam -e "SHOW TABLES;"
mysql -u root -p eecbafoussam -e "SELECT COUNT(*) FROM services;"

# === SAUVEGARDER ===
mysqldump -u root -p eecbafoussam > backup.sql

# === RESTAURER ===
mysql -u root -p eecbafoussam < backup.sql
```

**C'est tout! 🎉**

Le fichier `eecbafoussam.sql` contient TOUT ce qui est nécessaire.
