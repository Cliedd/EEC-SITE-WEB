<?php
/**
 * Script de configuration complète du système
 * Initialise tout: base de données, admin, tables de suivi
 */

// Configuration de base
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'eecbafoussam');

try {
    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Erreur de connexion: " . $conn->connect_error);
    }

    echo "✓ Connexion à la base de données réussie\n\n";

    // 1. Recréer la table admin_users
    echo "=== Création de la table admin_users ===\n";
    $sql = "DROP TABLE IF EXISTS admin_users";
    $conn->query($sql);

    $sql = "CREATE TABLE admin_users (
        id_admin INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(255) UNIQUE NOT NULL,
        mot_de_passe VARCHAR(255) NOT NULL,
        nom VARCHAR(100) NOT NULL,
        actif TINYINT(1) DEFAULT 1,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql)) {
        echo "✓ Table admin_users créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // 2. Créer un administrateur
    echo "\n=== Création du compte administrateur ===\n";
    
    $email = 'admin@eeccentremedical.com';
    $password = 'Admin@123456';
    $nom = 'Administrateur Principal';
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO admin_users (email, mot_de_passe, nom, actif) VALUES (?, ?, ?, 1)");
    if ($stmt === false) {
        throw new Exception("Erreur préparation: " . $conn->error);
    }

    $stmt->bind_param("sss", $email, $hashed_password, $nom);
    
    if ($stmt->execute()) {
        echo "✓ Admin créé\n";
        echo "  Email: $email\n";
        echo "  Mot de passe: $password\n";
    } else {
        throw new Exception("Erreur insertion admin: " . $stmt->error);
    }

    // 3. Créer table email_verifications
    echo "\n=== Création de la table email_verifications ===\n";
    
    $sql = "DROP TABLE IF EXISTS email_verifications";
    $conn->query($sql);

    $sql = "CREATE TABLE email_verifications (
        id INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL,
        entity_type VARCHAR(50) NOT NULL,
        verified_at TIMESTAMP NULL,
        verification_token VARCHAR(255) UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql)) {
        echo "✓ Table email_verifications créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // Vérifier l'email de l'admin
    $stmt = $conn->prepare("INSERT INTO email_verifications (email, entity_type, verified_at) VALUES (?, 'admin', NOW())");
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        echo "✓ Email de l'admin vérifié\n";
    }

    // 4. Créer table audit_logs
    echo "\n=== Création de la table audit_logs ===\n";
    
    $sql = "DROP TABLE IF EXISTS audit_logs";
    $conn->query($sql);

    $sql = "CREATE TABLE audit_logs (
        id INT PRIMARY KEY AUTO_INCREMENT,
        action_type VARCHAR(100) NOT NULL,
        entity_type VARCHAR(50),
        entity_id INT,
        user_email VARCHAR(255),
        details TEXT,
        status VARCHAR(50),
        ip_address VARCHAR(45),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql)) {
        echo "✓ Table audit_logs créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // 5. Créer table visitors
    echo "\n=== Création de la table visitors ===\n";
    
    $sql = "DROP TABLE IF EXISTS visitors";
    $conn->query($sql);

    $sql = "CREATE TABLE visitors (
        id_visitor INT PRIMARY KEY AUTO_INCREMENT,
        ip_address VARCHAR(45) NOT NULL,
        user_agent TEXT,
        page_visited VARCHAR(255),
        referrer VARCHAR(255),
        visit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        session_id VARCHAR(255),
        country VARCHAR(100),
        city VARCHAR(100)
    )";

    if ($conn->query($sql)) {
        echo "✓ Table visitors créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // 6. Créer table appointments
    echo "\n=== Création de la table appointments ===\n";
    
    $sql = "DROP TABLE IF EXISTS appointments";
    $conn->query($sql);

    $sql = "CREATE TABLE appointments (
        id_appointment INT PRIMARY KEY AUTO_INCREMENT,
        patient_name VARCHAR(255) NOT NULL,
        patient_email VARCHAR(255) NOT NULL,
        patient_phone VARCHAR(20),
        appointment_date DATETIME NOT NULL,
        appointment_time TIME,
        service_type VARCHAR(100),
        description TEXT,
        status VARCHAR(50) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql)) {
        echo "✓ Table appointments créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // 7. Créer table accounts
    echo "\n=== Création de la table accounts ===\n";
    
    $sql = "DROP TABLE IF EXISTS accounts";
    $conn->query($sql);

    $sql = "CREATE TABLE accounts (
        id_account INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(255) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        full_name VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        address TEXT,
        status VARCHAR(50) DEFAULT 'active',
        email_verified TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql)) {
        echo "✓ Table accounts créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // 8. Créer table services
    echo "\n=== Création de la table services ===\n";
    
    $sql = "DROP TABLE IF EXISTS services";
    $conn->query($sql);

    $sql = "CREATE TABLE services (
        id_service INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2),
        duration_minutes INT,
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql)) {
        echo "✓ Table services créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    // Insérer des services par défaut
    $services = [
        ['Consultation Générale', 'Consultation médicale générale', 50.00, 30],
        ['Visite Domicile', 'Visite médicale à domicile', 80.00, 45],
        ['Vaccination', 'Service de vaccination', 40.00, 20],
        ['Examen Dentaire', 'Examen dentaire complet', 60.00, 30],
        ['Suivi Grossesse', 'Suivi de grossesse', 70.00, 40],
    ];

    foreach ($services as $service) {
        $stmt = $conn->prepare("INSERT INTO services (name, description, price, duration_minutes) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $service[0], $service[1], $service[2], $service[3]);
        $stmt->execute();
    }
    echo "✓ Services par défaut créés\n";

    // 9. Créer table contacts
    echo "\n=== Création de la table contacts ===\n";
    
    $sql = "DROP TABLE IF EXISTS contacts";
    $conn->query($sql);

    $sql = "CREATE TABLE contacts (
        id_contact INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        subject VARCHAR(255),
        message TEXT NOT NULL,
        status VARCHAR(50) DEFAULT 'unread',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql)) {
        echo "✓ Table contacts créée\n";
    } else {
        throw new Exception("Erreur création table: " . $conn->error);
    }

    echo "\n" . str_repeat("=", 50) . "\n";
    echo "✓ SYSTÈME INITIALISÉ AVEC SUCCÈS\n";
    echo str_repeat("=", 50) . "\n";
    echo "Identifiants de connexion:\n";
    echo "  Email: $email\n";
    echo "  Mot de passe: $password\n";
    echo str_repeat("=", 50) . "\n";

} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}

$conn->close();
