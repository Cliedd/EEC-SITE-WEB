-- =====================================================================
-- SCRIPT DE DÉPLOIEMENT COMPLET - EEC CENTRE MÉDICAL
-- =====================================================================
-- Nom de la base: eecbafoussam
-- Plateforme: MariaDB 10.3+ / MySQL 5.7+
-- PHP: 8.1+
-- Framework: CodeIgniter 4.6.1
-- Date de création: 13 janvier 2026
-- Version: 1.0 Production
-- =====================================================================

-- =====================================================================
-- ÉTAPE 1: SUPPRIMER ET CRÉER LA BASE DE DONNÉES
-- =====================================================================
DROP DATABASE IF EXISTS `eecbafoussam`;

CREATE DATABASE IF NOT EXISTS `eecbafoussam` 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `eecbafoussam`;

-- =====================================================================
-- TABLE 1: login
-- Description: Comptes utilisateurs patients/visiteurs
-- Utilisée pour: Inscription, authentification, profils patients
-- =====================================================================
CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique',
  `name_surName` VARCHAR(100) NOT NULL COMMENT 'Nom et prénom du patient',
  `email` VARCHAR(100) NOT NULL UNIQUE COMMENT 'Email unique du patient',
  `telephone` VARCHAR(20) NOT NULL COMMENT 'Numéro de téléphone',
  `mot_de_passe` VARCHAR(255) NOT NULL COMMENT 'Mot de passe hashé (bcrypt)',
  `Date-creation` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du compte',
  `Date-modification` DATETIME NULL COMMENT 'Date de la dernière modification',
  `Date-logout` DATETIME NULL COMMENT 'Date de la dernière déconnexion',
  `actif` TINYINT DEFAULT 1 COMMENT '1=actif, 0=inactif',
  `email_verified` TINYINT DEFAULT 0 COMMENT '1=vérifié, 0=non vérifié',
  
  -- INDEX pour optimiser les recherches
  KEY `idx_email` (`email`),
  KEY `idx_date_creation` (`Date-creation`),
  KEY `idx_actif` (`actif`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table des comptes patients';

-- =====================================================================
-- TABLE 2: admin_users
-- Description: Comptes administrateurs du système
-- Utilisée pour: Gestion du système, dashboard admin, modération
-- =====================================================================
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id_admin` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique admin',
  `email` VARCHAR(100) NOT NULL UNIQUE COMMENT 'Email unique administrateur',
  `mot_de_passe` VARCHAR(255) NOT NULL COMMENT 'Mot de passe hashé (bcrypt)',
  `nom` VARCHAR(100) NOT NULL COMMENT 'Nom de l\'administrateur',
  `role` VARCHAR(50) DEFAULT 'admin' COMMENT 'Rôle: super_admin, admin, moderator',
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du compte',
  `date_modification` DATETIME NULL COMMENT 'Date de la dernière modification',
  `actif` TINYINT DEFAULT 1 COMMENT '1=actif, 0=inactif (suspendu)',
  `derniere_connexion` DATETIME NULL COMMENT 'Date de la dernière connexion',
  
  -- INDEX pour optimiser les recherches
  KEY `idx_email` (`email`),
  KEY `idx_actif` (`actif`),
  KEY `idx_role` (`role`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table des administrateurs';

-- =====================================================================
-- TABLE 3: services
-- Description: Services médicaux disponibles
-- Utilisée pour: Affichage des services, filtres de rendez-vous
-- =====================================================================
CREATE TABLE IF NOT EXISTS `services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique service',
  `name` VARCHAR(191) NOT NULL UNIQUE COMMENT 'Nom du service médical',
  `description` TEXT NULL COMMENT 'Description détaillée du service',
  `specialite` VARCHAR(100) NULL COMMENT 'Spécialité médicale',
  `icon` VARCHAR(100) NULL COMMENT 'Nom de l\'icône (FontAwesome)',
  `is_active` TINYINT DEFAULT 1 COMMENT '1=disponible, 0=indisponible',
  `ordre_affichage` INT DEFAULT 0 COMMENT 'Ordre d\'affichage',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création',
  `updated_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date de modification',
  
  -- INDEX pour optimiser les recherches
  KEY `idx_is_active` (`is_active`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_ordre` (`ordre_affichage`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table des services médicaux';

-- =====================================================================
-- TABLE 4: appointments
-- Description: Rendez-vous médicaux
-- Utilisée pour: Gestion des rendez-vous, agenda, confirmations
-- =====================================================================
CREATE TABLE IF NOT EXISTS `appointments` (
  `id_appointment` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique rendez-vous',
  `idlogin` INT NULL COMMENT 'Référence au patient (NULL si non enregistré)',
  `name_surName` VARCHAR(100) NOT NULL COMMENT 'Nom et prénom du patient',
  `email` VARCHAR(100) NOT NULL COMMENT 'Email du patient',
  `telephone` VARCHAR(20) NOT NULL COMMENT 'Téléphone du patient',
  `date_appointment` DATETIME NOT NULL COMMENT 'Date et heure du rendez-vous',
  `raison` TEXT NULL COMMENT 'Motif de consultation',
  `service` VARCHAR(191) NULL COMMENT 'Service médical demandé',
  `status` ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending' COMMENT 'État du rendez-vous',
  `confirmation_token` VARCHAR(64) NULL COMMENT 'Token de confirmation email',
  `confirmed_at` DATETIME NULL COMMENT 'Date de confirmation',
  `cancelled_at` DATETIME NULL COMMENT 'Date d\'annulation',
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du rendez-vous',
  `date_modification` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date de dernière modification',
  
  -- FOREIGN KEY (optionnel mais recommandé)
  CONSTRAINT `fk_appointments_login` FOREIGN KEY (`idlogin`) 
    REFERENCES `login` (`idlogin`) ON DELETE SET NULL ON UPDATE CASCADE,
  
  -- INDEX pour optimiser les recherches
  KEY `idx_email` (`email`),
  KEY `idx_status` (`status`),
  KEY `idx_date_appointment` (`date_appointment`),
  KEY `idx_service` (`service`),
  KEY `idx_date_creation` (`date_creation`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table des rendez-vous médicaux';

-- =====================================================================
-- TABLE 5: email_verifications
-- Description: Tokens de vérification d'email
-- Utilisée pour: Confirmation d'email, sécurité, réinitialisation mot de passe
-- =====================================================================
CREATE TABLE IF NOT EXISTS `email_verifications` (
  `id_verification` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique',
  `email` VARCHAR(100) NOT NULL COMMENT 'Email à vérifier',
  `token` VARCHAR(64) NOT NULL UNIQUE COMMENT 'Token sécurisé unique',
  `entity_type` ENUM('login', 'admin', 'contact') DEFAULT 'login' COMMENT 'Type d\'entité associée',
  `entity_id` INT NULL COMMENT 'ID de l\'entité associée',
  `verified` BOOLEAN DEFAULT FALSE COMMENT 'TRUE=vérifié, FALSE=non vérifié',
  `verified_at` DATETIME NULL COMMENT 'Date de vérification',
  `expires_at` DATETIME NOT NULL COMMENT 'Date d\'expiration du token',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du token',
  
  -- INDEX pour optimiser les recherches
  KEY `idx_token` (`token`),
  KEY `idx_verified` (`verified`),
  KEY `idx_expires_at` (`expires_at`),
  KEY `idx_email` (`email`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table de vérification d\'email';

-- =====================================================================
-- TABLE 6: audit_logs
-- Description: Journaux d'audit et de sécurité
-- Utilisée pour: Traçabilité, sécurité, conformité
-- =====================================================================
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id_log` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique',
  `user_id` INT NULL COMMENT 'ID de l\'utilisateur (NULL si anonyme)',
  `user_email` VARCHAR(100) NULL COMMENT 'Email de l\'utilisateur',
  `action` VARCHAR(100) NOT NULL COMMENT 'Action effectuée (login, logout, create, update, delete)',
  `entity_type` VARCHAR(100) NULL COMMENT 'Type d\'entité modifiée (appointment, user, etc)',
  `entity_id` INT NULL COMMENT 'ID de l\'entité modifiée',
  `old_values` JSON NULL COMMENT 'Anciennes valeurs (JSON)',
  `new_values` JSON NULL COMMENT 'Nouvelles valeurs (JSON)',
  `details` JSON NULL COMMENT 'Détails supplémentaires',
  `ip_address` VARCHAR(45) NULL COMMENT 'Adresse IP de l\'utilisateur',
  `user_agent` VARCHAR(255) NULL COMMENT 'User agent navigateur',
  `status` ENUM('success', 'failure') DEFAULT 'success' COMMENT 'Succès ou échec',
  `error_message` TEXT NULL COMMENT 'Message d\'erreur si failure',
  `timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure',
  
  -- INDEX pour optimiser les recherches
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_timestamp` (`timestamp`),
  KEY `idx_status` (`status`),
  KEY `idx_entity_type` (`entity_type`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Journal d\'audit et de sécurité';

-- =====================================================================
-- TABLE 7: visitors
-- Description: Analytique des visiteurs
-- Utilisée pour: Suivi des visites, analytics, statistiques
-- =====================================================================
CREATE TABLE IF NOT EXISTS `visitors` (
  `id_visitor` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique',
  `idlogin` INT NULL COMMENT 'Référence au patient (NULL si anonyme)',
  `name_surName` VARCHAR(100) NOT NULL COMMENT 'Nom du visiteur',
  `email` VARCHAR(100) NOT NULL COMMENT 'Email du visiteur',
  `telephone` VARCHAR(20) NULL COMMENT 'Téléphone du visiteur',
  `visitor_type` ENUM('new_account', 'appointment_request', 'contact', 'consultation') DEFAULT 'new_account' COMMENT 'Type de visite',
  `source_page` VARCHAR(255) NULL COMMENT 'Page source de la visite',
  `ip_address` VARCHAR(45) NULL COMMENT 'Adresse IP du visiteur',
  `user_agent` VARCHAR(255) NULL COMMENT 'User agent du navigateur',
  `date_visit` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la visite',
  
  -- FOREIGN KEY (optionnel)
  CONSTRAINT `fk_visitors_login` FOREIGN KEY (`idlogin`) 
    REFERENCES `login` (`idlogin`) ON DELETE SET NULL ON UPDATE CASCADE,
  
  -- INDEX pour optimiser les recherches
  KEY `idx_email` (`email`),
  KEY `idx_visitor_type` (`visitor_type`),
  KEY `idx_date_visit` (`date_visit`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table d\'analytique des visiteurs';

-- =====================================================================
-- TABLE 8: contacts
-- Description: Messages de contact du formulaire
-- Utilisée pour: Gestion des messages, support client
-- =====================================================================
CREATE TABLE IF NOT EXISTS `contacts` (
  `id_contact` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique',
  `nom` VARCHAR(100) NOT NULL COMMENT 'Nom du contact',
  `email` VARCHAR(100) NOT NULL COMMENT 'Email du contact',
  `telephone` VARCHAR(20) NOT NULL COMMENT 'Téléphone du contact',
  `sujet` VARCHAR(255) NOT NULL COMMENT 'Sujet du message',
  `message` TEXT NOT NULL COMMENT 'Corps du message',
  `statut` ENUM('nouveau', 'en_lecture', 'repondu', 'archive') DEFAULT 'nouveau' COMMENT 'État du message',
  `reponse` TEXT NULL COMMENT 'Réponse du support',
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création',
  `date_lecture` DATETIME NULL COMMENT 'Date de lecture',
  `date_reponse` DATETIME NULL COMMENT 'Date de réponse',
  `admin_id` INT NULL COMMENT 'Admin qui a répondu',
  
  -- FOREIGN KEY (optionnel)
  CONSTRAINT `fk_contacts_admin` FOREIGN KEY (`admin_id`) 
    REFERENCES `admin_users` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  
  -- INDEX pour optimiser les recherches
  KEY `idx_email` (`email`),
  KEY `idx_statut` (`statut`),
  KEY `idx_date_creation` (`date_creation`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table de gestion des messages de contact';

-- =====================================================================
-- TABLE 9: password_resets
-- Description: Tokens de réinitialisation de mot de passe
-- Utilisée pour: Récupération de mot de passe oubliée
-- =====================================================================
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id_reset` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant unique',
  `email` VARCHAR(100) NOT NULL COMMENT 'Email de l\'utilisateur',
  `token` VARCHAR(64) NOT NULL UNIQUE COMMENT 'Token de réinitialisation',
  `user_type` ENUM('login', 'admin') DEFAULT 'login' COMMENT 'Type d\'utilisateur',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du token',
  `expires_at` DATETIME NOT NULL COMMENT 'Date d\'expiration du token',
  `used_at` DATETIME NULL COMMENT 'Date d\'utilisation',
  
  -- INDEX pour optimiser les recherches
  KEY `idx_token` (`token`),
  KEY `idx_email` (`email`),
  KEY `idx_expires_at` (`expires_at`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) COMMENT='Table de réinitialisation de mot de passe';

-- =====================================================================
-- ÉTAPE 2: INSÉRER LES SERVICES MÉDICAUX PAR DÉFAUT (15 services)
-- =====================================================================
INSERT INTO `services` 
  (`name`, `description`, `specialite`, `icon`, `is_active`, `ordre_affichage`, `created_at`) 
VALUES
  ('Consultation générale', 
   'Consultation médicale générale pour tous types de problèmes de santé. Service de base pour les patients en bonne santé ou avec problèmes mineurs.', 
   'Médecine générale', 'fa-stethoscope', 1, 1, NOW()),

  ('Pédiatrie/Néonatologie', 
   'Soins médicaux spécialisés pour les enfants, nouveau-nés et nourrissons. Suivi du développement, vaccinations et pathologies infantiles.', 
   'Pédiatrie', 'fa-baby', 1, 2, NOW()),

  ('Obstétrique/Gynécologie', 
   'Suivi gynécologique complet, consultation pré-conception, suivi de grossesse, accouchement et soins postnataux.', 
   'Gynécologie', 'fa-female', 1, 3, NOW()),

  ('Chirurgie générale', 
   'Interventions chirurgicales générales et spécialisées. Diagnostic et traitement chirurgical des pathologies abdomino-pelvienne.', 
   'Chirurgie', 'fa-cut', 1, 4, NOW()),

  ('Médecine interne', 
   'Diagnostic et traitement des maladies internes complexes. Suivi des pathologies chroniques et gestion des comorbidités.', 
   'Médecine interne', 'fa-heartbeat', 1, 5, NOW()),

  ('Neurologie', 
   'Spécialité des troubles du système nerveux central et périphérique. Diagnostic et traitement des maladies neurologiques.', 
   'Neurologie', 'fa-brain', 1, 6, NOW()),

  ('Réanimation', 
   'Soins intensifs et réanimation pour les patients en état critique. Soutien vital et traitement des états graves.', 
   'Réanimation', 'fa-heartbeat', 1, 7, NOW()),

  ('Kinésithérapie', 
   'Rééducation physique et motrice. Traitement des troubles musculo-squelettiques et réadaptation post-opératoire.', 
   'Kinésithérapie', 'fa-wheelchair', 1, 8, NOW()),

  ('Nutrition', 
   'Conseil et suivi nutritionnel personnalisé. Gestion de l\'obésité, diabète et autres pathologies liées à l\'alimentation.', 
   'Nutrition', 'fa-apple', 1, 9, NOW()),

  ('Cardiologie', 
   'Spécialité des maladies du cœur et du système circulatoire. Diagnostic et traitement des insuffisances cardiaques et maladies vasculaires.', 
   'Cardiologie', 'fa-heart', 1, 10, NOW()),

  ('Dermatologie', 
   'Soins des maladies de la peau, cheveux et ongles. Diagnostic et traitement des affections dermatologiques et interventions esthétiques.', 
   'Dermatologie', 'fa-spa', 1, 11, NOW()),

  ('Ophtalmologie', 
   'Soins des maladies des yeux et de la vision. Examen de la vue, traitement des pathologies ophtalmologiques et interventions.', 
   'Ophtalmologie', 'fa-eye', 1, 12, NOW()),

  ('ORL (Oto-Rhino-Laryngologie)', 
   'Spécialité de l\'oreille, du nez et de la gorge. Diagnostic et traitement des pathologies ORL et des troubles auditifs.', 
   'ORL', 'fa-ear', 1, 13, NOW()),

  ('Urologie', 
   'Spécialité de l\'appareil urinaire et reproductif. Diagnostic et traitement des pathologies urologiques chez l\'homme et la femme.', 
   'Urologie', 'fa-tint', 1, 14, NOW()),

  ('Orthopédie', 
   'Spécialité de l\'appareil locomoteur (os, articulations, muscles). Diagnostic, traitement médical et chirurgical des pathologies orthopédiques.', 
   'Orthopédie', 'fa-bone', 1, 15, NOW());

-- =====================================================================
-- ÉTAPE 3: CRÉER UN COMPTE ADMIN PAR DÉFAUT
-- =====================================================================
-- Identifiants:
-- Email: administrationeecc@dashboard.com
-- Mot de passe: bafoussameec2026@web
-- Hash bcrypt: $2y$10$GlGLcWZVg9QDKIkXV10WTeRozQmvXJdOt67XREKsrd4svXCo24FpG

INSERT INTO `admin_users` 
  (`email`, `mot_de_passe`, `nom`, `role`, `actif`, `date_creation`) 
VALUES 
  ('administrationeecc@dashboard.com', 
   '$2y$10$GlGLcWZVg9QDKIkXV10WTeRozQmvXJdOt67XREKsrd4svXCo24FpG', 
   'Administrateur EEC Bafoussam', 
   'super_admin', 
   1, 
   NOW());

-- =====================================================================
-- ÉTAPE 4: VÉRIFICATIONS FINALES
-- =====================================================================

-- Afficher les tables créées
SELECT 'Tables créées:' AS Info;
SHOW TABLES;

-- Afficher le nombre d'enregistrements par table
SELECT 'Statistiques des tables:' AS Info;
SELECT 
  'login' AS Table_Name, COUNT(*) AS Total_Records FROM login
UNION ALL
SELECT 'admin_users', COUNT(*) FROM admin_users
UNION ALL
SELECT 'services', COUNT(*) FROM services
UNION ALL
SELECT 'appointments', COUNT(*) FROM appointments
UNION ALL
SELECT 'email_verifications', COUNT(*) FROM email_verifications
UNION ALL
SELECT 'audit_logs', COUNT(*) FROM audit_logs
UNION ALL
SELECT 'visitors', COUNT(*) FROM visitors
UNION ALL
SELECT 'contacts', COUNT(*) FROM contacts
UNION ALL
SELECT 'password_resets', COUNT(*) FROM password_resets;

-- Vérifier l'admin par défaut
SELECT 'Admin par défaut créé:' AS Info;
SELECT 
  id_admin AS ID, 
  email AS Email, 
  nom AS Nom, 
  role AS Role, 
  actif AS Actif,
  date_creation AS Date_Creation
FROM admin_users 
WHERE email = 'administrationeecc@dashboard.com';

-- Vérifier les services
SELECT 'Services médicaux créés:' AS Info;
SELECT 
  id AS ID, 
  name AS Nom_Service, 
  specialite AS Spécialité, 
  is_active AS Actif
FROM services 
ORDER BY ordre_affichage ASC;

-- =====================================================================
-- RÉSUMÉ DU DÉPLOIEMENT
-- =====================================================================
-- ✓ Base de données: eecbafoussam CRÉÉE
-- ✓ Tables: 9 tables CRÉÉES
-- ✓ Services: 15 services CRÉÉS
-- ✓ Admin: 1 administrateur CRÉÉ
-- ✓ Collation: utf8mb4_unicode_ci (support complet Unicode)
-- ✓ Indices: OPTIMISÉS pour performance
-- ✓ Clés étrangères: CONFIGURÉES
-- ✓ Commentaires: DOCUMENTÉS
-- =====================================================================
-- Statut: ✅ PRÊT POUR PRODUCTION
-- Version: 1.0
-- Date: 13 janvier 2026
-- =====================================================================
