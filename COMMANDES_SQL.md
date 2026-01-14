# 🗄️ BONNES PRATIQUES & COMMANDES SQL AVANCÉES

**Version:** 1.0 | **Updated:** January 13, 2026

---

## 📌 RÉSUMÉ RAPIDE

**Charger TOUTE la base (UNE SEULE COMMANDE):**
```bash
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

**C'est tout! Les 8 tables + données sont créées automatiquement.**

---

## 🚀 DÉMARRAGE IMMÉDIAT

### Windows (WAMP)
```cmd
cd C:\wamp64\www\eec-site
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

### Linux
```bash
cd /var/www/eec-site
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

---

## 📊 LES 8 TABLES CRÉÉES

```sql
1. login              - Comptes patients
2. admin_users        - Administrateurs
3. visitors           - Statistiques visiteurs
4. contact_messages   - Messages de contact
5. appointments       - Rendez-vous médicaux
6. services           - Services médicaux
7. email_verifications - Tokens vérification
8. audit_logs         - Journal d'activité
```

---

## ✅ VÉRIFIER L'INSTALLATION

### Vérifier les tables
```bash
mysql -u root -p eecbafoussam -e "SHOW TABLES;"
```

**Résultat attendu: 8 tables** ✅

### Vérifier les données
```bash
mysql -u root -p eecbafoussam -e "SELECT COUNT(*) FROM services;"
# Résultat: 15 services

mysql -u root -p eecbafoussam -e "SELECT COUNT(*) FROM admin_users;"
# Résultat: 1 administrateur
```

### Vérifier la structure
```bash
mysql -u root -p eecbafoussam -e "DESCRIBE users;"
# Affiche les colonnes de la table users
```

---

## 💾 SAUVEGARDES & RESTAURATIONS

### Sauvegarder la base (Snapshot)
```bash
# Backup avec date/heure
mysqldump -u root -p eecbafoussam > eec_backup_$(date +%Y%m%d_%H%M%S).sql

# Ou simple
mysqldump -u root -p eecbafoussam > eec_backup.sql
```

### Restaurer une sauvegarde
```bash
# Depuis le fichier SQL
mysql -u root -p eecbafoussam < eec_backup.sql

# Ou via MySQL CLI
mysql -u root -p
USE eecbafoussam;
SOURCE /chemin/vers/eec_backup.sql;
```

### Sauvegarder table spécifique
```bash
mysqldump -u root -p eecbafoussam appointments > appointments_backup.sql
```

---

## 🔄 RÉINITIALISER LA BASE (⚠️ Efface tout!)

```bash
# ⚠️ ATTENTION: Cela supprime TOUTES les données!

# Supprimer la base
mysql -u root -p -e "DROP DATABASE eecbafoussam;"

# Recréer
mysql -u root -p -e "CREATE DATABASE eecbafoussam CHARACTER SET utf8mb4;"

# Réimporter le dump
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

---

## 👤 GESTION DES ADMINISTRATEURS

### Voir tous les admins
```sql
SELECT id_admin, email, nom, actif, date_creation FROM admin_users;
```

### Ajouter un nouvel admin
```sql
INSERT INTO admin_users (
  email,
  mot_de_passe,
  nom,
  date_creation,
  actif
) VALUES (
  'nouvel.admin@example.com',
  '$2y$10$abc123def456...',  -- Bcrypt hash
  'Nouvel Administrateur',
  NOW(),
  1
);
```

### Réinitialiser mot de passe admin
```sql
UPDATE admin_users 
SET mot_de_passe = '$2y$10$new_bcrypt_hash'
WHERE email = 'admin@example.com';
```

### Désactiver un admin
```sql
UPDATE admin_users SET actif = 0 WHERE email = 'admin@example.com';
```

### Réactiver un admin
```sql
UPDATE admin_users SET actif = 1 WHERE email = 'admin@example.com';
```

### Supprimer un admin
```sql
DELETE FROM admin_users WHERE email = 'admin@example.com';
```

---

## 📋 GESTION DES RENDEZ-VOUS

### Voir tous les RDV
```sql
SELECT * FROM appointments ORDER BY appointment_date DESC;
```

### RDV d'aujourd'hui
```sql
SELECT * FROM appointments 
WHERE DATE(appointment_date) = CURDATE();
```

### RDV du mois courant
```sql
SELECT * FROM appointments 
WHERE MONTH(appointment_date) = MONTH(NOW())
AND YEAR(appointment_date) = YEAR(NOW());
```

### RDV futurs
```sql
SELECT * FROM appointments 
WHERE appointment_date >= CURDATE()
ORDER BY appointment_date ASC;
```

### RDV passés
```sql
SELECT * FROM appointments 
WHERE appointment_date < CURDATE()
ORDER BY appointment_date DESC;
```

### RDV par service
```sql
SELECT service, COUNT(*) as nombre 
FROM appointments 
GROUP BY service 
ORDER BY nombre DESC;
```

### RDV par status
```sql
SELECT status, COUNT(*) as nombre 
FROM appointments 
GROUP BY status;

-- Résultat:
-- pending    | 5
-- confirmed  | 10
-- completed  | 8
-- cancelled  | 2
```

### Confirmer un RDV (status)
```sql
UPDATE appointments 
SET status = 'confirmed'
WHERE id = 123;
```

### Annuler un RDV
```sql
UPDATE appointments 
SET status = 'cancelled'
WHERE id = 123;
```

### Marquer comme complété
```sql
UPDATE appointments 
SET status = 'completed'
WHERE id = 123;
```

### Supprimer un RDV
```sql
DELETE FROM appointments WHERE id = 123;
```

---

## 👥 GESTION DES PATIENTS

### Voir tous les patients
```sql
SELECT idlogin, name_surName, email, telephone, Date_creation 
FROM login 
ORDER BY Date_creation DESC;
```

### Compter les patients
```sql
SELECT COUNT(*) as total_patients FROM login;
```

### Patients inscrits ce mois
```sql
SELECT * FROM login 
WHERE MONTH(Date_creation) = MONTH(NOW())
AND YEAR(Date_creation) = YEAR(NOW());
```

### Rechercher un patient
```sql
SELECT * FROM login WHERE email = 'jean@example.com';
```

### Mettre à jour patient
```sql
UPDATE login 
SET telephone = '+33612345678'
WHERE email = 'jean@example.com';
```

### Supprimer un patient
```sql
DELETE FROM login WHERE email = 'jean@example.com';
```

---

## 🏥 GESTION DES SERVICES

### Voir tous les services
```sql
SELECT * FROM services;
```

### Compter les services
```sql
SELECT COUNT(*) FROM services;
# Résultat: 15
```

### Ajouter un service
```sql
INSERT INTO services (
  name,
  description,
  specialite,
  icon,
  Date_creation
) VALUES (
  'Oncologie',
  'Traitement des cancers',
  'Oncologie',
  'fa-disease',
  NOW()
);
```

### Modifier un service
```sql
UPDATE services 
SET description = 'Nouvelle description'
WHERE name = 'Cardiologie';
```

### Supprimer un service
```sql
DELETE FROM services WHERE name = 'Cardiologie';
```

---

## 📧 GESTION DES EMAILS & VÉRIFICATIONS

### Voir les tokens en attente
```sql
SELECT * FROM email_verifications 
WHERE verified_at IS NULL;
```

### Vérifier un email manuellement
```sql
UPDATE email_verifications 
SET verified_at = NOW()
WHERE email = 'jean@example.com';
```

### Tokens expirés
```sql
SELECT * FROM email_verifications 
WHERE verified_at IS NULL
AND expires_at < NOW();
```

### Supprimer tokens expirés
```sql
DELETE FROM email_verifications 
WHERE expires_at < NOW();
```

---

## 📊 STATISTIQUES & RAPPORTS

### Statistiques globales
```sql
SELECT 
  (SELECT COUNT(*) FROM login) as total_patients,
  (SELECT COUNT(*) FROM appointments) as total_rdv,
  (SELECT COUNT(*) FROM admin_users) as total_admins,
  (SELECT COUNT(*) FROM services) as total_services;
```

### Service le plus demandé
```sql
SELECT service, COUNT(*) as nombre 
FROM appointments 
GROUP BY service 
ORDER BY nombre DESC 
LIMIT 1;
```

### Patients les plus actifs (RDV)
```sql
SELECT patient_email, COUNT(*) as nombre_rdv 
FROM appointments 
GROUP BY patient_email 
ORDER BY nombre_rdv DESC 
LIMIT 10;
```

### RDV par jour de la semaine
```sql
SELECT DAYNAME(appointment_date) as jour, COUNT(*) as nombre 
FROM appointments 
WHERE appointment_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY DAYNAME(appointment_date);
```

### RDV par heure
```sql
SELECT HOUR(appointment_time) as heure, COUNT(*) as nombre 
FROM appointments 
GROUP BY HOUR(appointment_time)
ORDER BY heure;
```

---

## 🔒 SÉCURITÉ & MAINTENANCE

### Voir les logs d'activité
```sql
SELECT * FROM audit_logs 
ORDER BY created_at DESC 
LIMIT 50;
```

### Logs d'une journée
```sql
SELECT * FROM audit_logs 
WHERE DATE(created_at) = CURDATE();
```

### Logs d'un utilisateur
```sql
SELECT * FROM audit_logs 
WHERE user_id = 5 
ORDER BY created_at DESC;
```

### Supprimer les logs anciens (>30 jours)
```sql
DELETE FROM audit_logs 
WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY);
```

---

## 🧹 NETTOYAGE & OPTIMISATION

### Vider une table (garder la structure)
```sql
TRUNCATE TABLE appointments;
```

### Réinitialiser l'auto-increment
```sql
ALTER TABLE appointments AUTO_INCREMENT = 1;
```

### Optimiser les tables
```sql
OPTIMIZE TABLE login;
OPTIMIZE TABLE admin_users;
OPTIMIZE TABLE appointments;
```

### Vérifier l'intégrité
```sql
CHECK TABLE login;
CHECK TABLE appointments;
```

### Réparer une table (si corruption)
```sql
REPAIR TABLE appointments;
```

---

## 📈 PERFORMANCE

### Voir les index
```sql
SHOW INDEX FROM appointments;
```

### Taille de la base de données
```sql
SELECT 
  table_name,
  ROUND(((data_length + index_length) / 1024 / 1024), 2) as 'Size in MB'
FROM information_schema.TABLES 
WHERE table_schema = 'eecbafoussam';
```

### Compter les lignes
```sql
SELECT 
  table_name,
  table_rows
FROM information_schema.TABLES 
WHERE table_schema = 'eecbafoussam';
```

---

## 🔄 TRANSACTIONS (Avancé)

### Exécuter plusieurs requêtes atomiquement
```sql
START TRANSACTION;

INSERT INTO appointments (...) VALUES (...);
UPDATE admin_users SET ... WHERE ...;

COMMIT;  -- Valider
-- OU
ROLLBACK;  -- Annuler
```

---

## ✅ CHECKLIST MAINTENANCE

```
□ Backup quotidien créé
□ Logs vérifiés pour erreurs
□ Tables optimisées
□ Intégrité vérifiée (CHECK TABLE)
□ Mots de passe admins changés régulièrement
□ Tokens expirés nettoyés
□ Ancien audit_logs supprimé (>30j)
□ Espace disque vérifié
□ Permissions fichiers correctes
```

---

## 🚨 ERREURS COURANTES

### "Duplicate entry"
```bash
# Vous essayez d'ajouter un email qui existe déjà
# Solution: Vérifier les doublons
SELECT email, COUNT(*) FROM login GROUP BY email HAVING COUNT(*) > 1;
```

### "Table doesn't exist"
```bash
# La table n'a pas été créée
# Solution: Réimporter le dump
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

### "Access denied"
```bash
# Mauvais identifiant MySQL
# Solution: Vérifier le mot de passe
mysql -u root -p
# Entrer le bon mot de passe
```

### "Out of memory"
```bash
# Augmenter la limite mémoire
SET SESSION max_allowed_packet = 16 * 1024 * 1024;
```

---

## 💾 EXPORT DONNÉES

### Exporter en CSV
```bash
mysql -u root -p eecbafoussam -e "SELECT * FROM appointments;" > appointments.csv
```

### Exporter en JSON (via PHP)
```php
// Dans un contrôleur CodeIgniter
$appointments = $this->appointmentModel->findAll();
return json_encode($appointments);
```

---

## 🎯 RÉSUMÉ

**Commande la plus importante:**
```bash
mysql -u root -p eecbafoussam < eecbafoussam.sql
```

**Verification:**
```bash
mysql -u root -p eecbafoussam -e "SHOW TABLES;"
```

**C'est tout! Vous avez une base de données complète et prête! 🎉**

---

**Dernière mise à jour:** January 13, 2026  
**Version:** 1.0  
**Status:** ✅ Complet
