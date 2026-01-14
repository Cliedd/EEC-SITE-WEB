-- =====================================================================
-- SCRIPT DE DÉPLOIEMENT COMPLET - EEC CENTRE MÉDICAL
-- Plateforme: Debian 12 + MariaDB 10.11.14
-- Date: 12 janvier 2026
-- Framework: CodeIgniter 4 + PHP 8.1+
-- =====================================================================

-- ÉTAPE 1: CRÉER LA BASE DE DONNÉES
-- =====================================================================
CREATE DATABASE IF NOT EXISTS `eecbafoussam` 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_general_ci;

USE `eecbafoussam`;

-- =====================================================================
-- TABLE 1: login (Comptes utilisateurs patients)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` INT AUTO_INCREMENT PRIMARY KEY,
  `name_surName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `telephone` VARCHAR(20) NOT NULL,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `Date-creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `Date-modification` DATETIME NULL,
  `Date-logout` DATETIME NULL,
  KEY `idx_email` (`email`),
  KEY `idx_date_creation` (`Date-creation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 2: admin_users (Comptes administrateur)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id_admin` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `nom` VARCHAR(100) NOT NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_modification` DATETIME NULL,
  `actif` TINYINT DEFAULT 1,
  KEY `idx_email` (`email`),
  KEY `idx_actif` (`actif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 3: visitors (Visiteurs - Analytics)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `visitors` (
  `id_visitor` INT AUTO_INCREMENT PRIMARY KEY,
  `idlogin` INT NULL,
  `name_surName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `visitor_type` ENUM('new_account', 'appointment_request', 'contact') DEFAULT 'new_account',
  `date_visit` DATETIME DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_email` (`email`),
  KEY `idx_visitor_type` (`visitor_type`),
  KEY `idx_date_visit` (`date_visit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 4: services (Services médicaux disponibles)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(191) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `is_active` TINYINT DEFAULT 1 COMMENT '1=disponible, 0=indisponible',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  KEY `idx_is_active` (`is_active`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 5: appointments (Rendez-vous)
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
  `status` ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_modification` DATETIME NULL,
  KEY `idx_email` (`email`),
  KEY `idx_status` (`status`),
  KEY `idx_date_appointment` (`date_appointment`),
  KEY `idx_service` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 6: email_verifications (Tokens de vérification email)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `email_verifications` (
  `id_verification` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `token` VARCHAR(64) NOT NULL UNIQUE,
  `entity_type` ENUM('login', 'admin', 'contact') DEFAULT 'login',
  `entity_id` INT NULL,
  `verified` BOOLEAN DEFAULT FALSE,
  `verified_at` DATETIME NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL,
  KEY `idx_verified` (`verified`),
  KEY `idx_expires_at` (`expires_at`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 7: audit_logs (Logs de sécurité - Audit trail)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id_log` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NULL,
  `user_email` VARCHAR(100) NULL,
  `action` VARCHAR(100) NOT NULL,
  `entity_type` VARCHAR(100) NULL,
  `entity_id` INT NULL,
  `details` JSON NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` VARCHAR(255) NULL,
  `status` ENUM('success', 'failure') DEFAULT 'success',
  `timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_timestamp` (`timestamp`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- TABLE 8: contacts (Messages de contact du formulaire)
-- =====================================================================
CREATE TABLE IF NOT EXISTS `contacts` (
  `id_contact` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `sujet` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `statut` ENUM('nouveau', 'en_lecture', 'repondu', 'archive') DEFAULT 'nouveau',
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_reponse` DATETIME NULL,
  KEY `idx_email` (`email`),
  KEY `idx_statut` (`statut`),
  KEY `idx_date_creation` (`date_creation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================================
-- ÉTAPE 2: INSÉRER LES SERVICES MÉDICAUX PAR DÉFAUT
-- =====================================================================
INSERT INTO `services` (`name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
('Consultation générale', 'Consultation médicale générale pour tous types de problèmes de santé', 1, NOW(), NOW()),
('Pédiatrie/Néonatologie', 'Soins médicaux spécialisés pour les enfants et nouveau-nés', 1, NOW(), NOW()),
('Obstétrique/Gynécologie', 'Suivi gynécologique et suivi de grossesse', 1, NOW(), NOW()),
('Chirurgie générale', 'Interventions chirurgicales diverses', 1, NOW(), NOW()),
('Médecine interne', 'Diagnostic et traitement des maladies internes', 1, NOW(), NOW()),
('Neurologie', 'Spécialité des troubles du système nerveux', 1, NOW(), NOW()),
('Réanimation', 'Soins intensifs et réanimation', 1, NOW(), NOW()),
('Kinésithérapie', 'Rééducation physique et motrice', 1, NOW(), NOW()),
('Nutrition', 'Conseil et suivi nutritionnel', 1, NOW(), NOW()),
('Cardiologie', 'Spécialité des maladies du cœur et du système circulatoire', 1, NOW(), NOW()),
('Dermatologie', 'Soins des maladies de la peau', 1, NOW(), NOW()),
('Ophtalmologie', 'Soins des maladies des yeux', 1, NOW(), NOW()),
('ORL', 'Spécialité de l\'oreille, du nez et de la gorge', 1, NOW(), NOW()),
('Urologie', 'Spécialité de l\'appareil urinaire', 1, NOW(), NOW()),
('Orthopédie', 'Spécialité de l\'appareil locomoteur', 1, NOW(), NOW());

-- =====================================================================
-- ÉTAPE 3: CRÉER UN COMPTE ADMIN DE DÉMONSTRATION
-- =====================================================================
-- Email: administrationeecc@dashboard.com
-- Mot de passe: bafoussameec2026@web (bcrypt)
INSERT INTO `admin_users` (`email`, `mot_de_passe`, `nom`, `actif`, `date_creation`)
VALUES (
  'administrationeecc@dashboard.com',
  '$2y$10$GlGLcWZVg9QDKIkXV10WTeRozQmvXJdOt67XREKsrd4svXCo24FpG',
  'Administrateur EEC',
  1,
  NOW()
);

-- =====================================================================
-- ÉTAPE 4: VÉRIFICATIONS FINALES
-- =====================================================================
-- Afficher les tables créées
SHOW TABLES;

-- Afficher les informations de structure
DESCRIBE login;
DESCRIBE admin_users;
DESCRIBE services;
DESCRIBE appointments;
DESCRIBE email_verifications;
DESCRIBE audit_logs;
DESCRIBE visitors;
DESCRIBE contacts;

-- =====================================================================
-- FIN DU SCRIPT DE DÉPLOIEMENT
-- Statut: ✓ PRÊT POUR PRODUCTION
-- =====================================================================
