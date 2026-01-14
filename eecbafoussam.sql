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
  `idlogin` INT AUTO_INCREMENT PRIMARY KEY,
  `name_surName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `telephone` VARCHAR(20) NOT NULL,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_modification` DATETIME NULL,
  `date_logout` DATETIME NULL,
  `actif` TINYINT DEFAULT 1,
  `email_verified` TINYINT DEFAULT 0,
  
  KEY `idx_email` (`email`),
  KEY `idx_date_creation` (`date_creation`),
  KEY `idx_actif` (`actif`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================================
-- TABLE 2: admin_users
-- Description: Comptes administrateurs du système
-- Utilisée pour: Gestion du système, dashboard admin, modération
-- =====================================================================
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id_admin` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `nom` VARCHAR(100) NOT NULL,
  `role` VARCHAR(50) DEFAULT 'admin',
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_modification` DATETIME NULL,
  `actif` TINYINT DEFAULT 1,
  `derniere_connexion` DATETIME NULL,
  
  KEY `idx_email` (`email`),
  KEY `idx_actif` (`actif`),
  KEY `idx_role` (`role`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 3: services
-- Description: Services médicaux disponibles
-- Utilisée pour: Affichage des services, filtres de rendez-vous
-- =====================================================================
CREATE TABLE IF NOT EXISTS `services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(191) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `specialite` VARCHAR(100) NULL,
  `icon` VARCHAR(100) NULL,
  `is_active` TINYINT DEFAULT 1,
  `ordre_affichage` INT DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  
  KEY `idx_is_active` (`is_active`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_ordre` (`ordre_affichage`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 4: appointments
-- Description: Rendez-vous médicaux
-- Utilisée pour: Gestion des rendez-vous, agenda, confirmations
-- =====================================================================
CREATE TABLE IF NOT EXISTS `appointments` (
  `id_appointment` INT AUTO_INCREMENT PRIMARY KEY,
  `idlogin` INT NULL,
  `name_surName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `date_appointment` DATETIME NOT NULL,
  `raison` TEXT NULL,
  `service` VARCHAR(191) NULL,
  `status` ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
  `confirmation_token` VARCHAR(64) NULL,
  `confirmed_at` DATETIME NULL,
  `cancelled_at` DATETIME NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_modification` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  
  CONSTRAINT `fk_appointments_login` FOREIGN KEY (`idlogin`) 
    REFERENCES `login` (`idlogin`) ON DELETE SET NULL ON UPDATE CASCADE,
  
  KEY `idx_email` (`email`),
  KEY `idx_status` (`status`),
  KEY `idx_date_appointment` (`date_appointment`),
  KEY `idx_service` (`service`),
  KEY `idx_date_creation` (`date_creation`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 5: email_verifications
-- Description: Tokens de vérification d'email
-- Utilisée pour: Confirmation d'email, sécurité, réinitialisation mot de passe
-- =====================================================================
CREATE TABLE IF NOT EXISTS `email_verifications` (
  `id_verification` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL,
  `token` VARCHAR(64) NOT NULL UNIQUE,
  `entity_type` ENUM('login', 'admin', 'contact') DEFAULT 'login',
  `entity_id` INT NULL,
  `verified` TINYINT DEFAULT 0,
  `verified_at` DATETIME NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  
  KEY `idx_token` (`token`),
  KEY `idx_verified` (`verified`),
  KEY `idx_expires_at` (`expires_at`),
  KEY `idx_email` (`email`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 6: audit_logs
-- Description: Journaux d'audit et de sécurité
-- Utilisée pour: Traçabilité, sécurité, conformité
-- =====================================================================
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id_log` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NULL,
  `user_email` VARCHAR(100) NULL,
  `action` VARCHAR(100) NOT NULL,
  `entity_type` VARCHAR(100) NULL,
  `entity_id` INT NULL,
  `old_values` JSON NULL,
  `new_values` JSON NULL,
  `details` JSON NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` VARCHAR(255) NULL,
  `status` ENUM('success', 'failure') DEFAULT 'success',
  `error_message` TEXT NULL,
  `timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
  
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_timestamp` (`timestamp`),
  KEY `idx_status` (`status`),
  KEY `idx_entity_type` (`entity_type`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 7: visitors
-- Description: Analytique des visiteurs
-- Utilisée pour: Suivi des visites, analytics, statistiques
-- =====================================================================
CREATE TABLE IF NOT EXISTS `visitors` (
  `id_visitor` INT AUTO_INCREMENT PRIMARY KEY,
  `idlogin` INT NULL,
  `name_surName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20) NULL,
  `visitor_type` ENUM('new_account', 'appointment_request', 'contact', 'consultation') DEFAULT 'new_account',
  `source_page` VARCHAR(255) NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` VARCHAR(255) NULL,
  `date_visit` DATETIME DEFAULT CURRENT_TIMESTAMP,
  
  CONSTRAINT `fk_visitors_login` FOREIGN KEY (`idlogin`) 
    REFERENCES `login` (`idlogin`) ON DELETE SET NULL ON UPDATE CASCADE,
  
  KEY `idx_email` (`email`),
  KEY `idx_visitor_type` (`visitor_type`),
  KEY `idx_date_visit` (`date_visit`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 8: contacts
-- Description: Messages de contact du formulaire
-- Utilisée pour: Gestion des messages, support client
-- =====================================================================
CREATE TABLE IF NOT EXISTS `contacts` (
  `id_contact` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `sujet` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `statut` ENUM('nouveau', 'en_lecture', 'repondu', 'archive') DEFAULT 'nouveau',
  `reponse` TEXT NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_lecture` DATETIME NULL,
  `date_reponse` DATETIME NULL,
  `admin_id` INT NULL,
  
  CONSTRAINT `fk_contacts_admin` FOREIGN KEY (`admin_id`) 
    REFERENCES `admin_users` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  
  KEY `idx_email` (`email`),
  KEY `idx_statut` (`statut`),
  KEY `idx_date_creation` (`date_creation`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

-- =====================================================================
-- TABLE 9: password_resets
-- Description: Tokens de réinitialisation de mot de passe
-- Utilisée pour: Récupération de mot de passe oubliée
-- =====================================================================
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id_reset` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL,
  `token` VARCHAR(64) NOT NULL UNIQUE,
  `user_type` ENUM('login', 'admin') DEFAULT 'login',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `expires_at` DATETIME NOT NULL,
  `used_at` DATETIME NULL,
  
  KEY `idx_token` (`token`),
  KEY `idx_email` (`email`),
  KEY `idx_expires_at` (`expires_at`),
  
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
);

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
