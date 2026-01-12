<?php
$conn = new mysqli('localhost', 'root', '', 'eecbafoussam');

// Drop existing
$conn->query('DROP TABLE IF EXISTS services');
$conn->query('DROP TABLE IF EXISTS contacts');
$conn->query('DROP TABLE IF EXISTS accounts');

// Create services
$sql = "CREATE TABLE services (
    id_service INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    description TEXT,
    price DECIMAL(10,2),
    duration_minutes INT,
    is_active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql)) echo "✓ Table services créée\n";

// Create contacts
$sql = "CREATE TABLE contacts (
    id_contact INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT,
    status VARCHAR(50) DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql)) echo "✓ Table contacts créée\n";

// Create accounts
$sql = "CREATE TABLE accounts (
    id_account INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255),
    full_name VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    status VARCHAR(50) DEFAULT 'active',
    email_verified TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql)) echo "✓ Table accounts créée\n";

// Insert services
echo "Insertion des services...\n";
$conn->query("INSERT INTO services (name, description, price, duration_minutes) VALUES ('Consultation Générale', 'Consultation', 50, 30)");
$conn->query("INSERT INTO services (name, description, price, duration_minutes) VALUES ('Visite Domicile', 'Visite', 80, 45)");
$conn->query("INSERT INTO services (name, description, price, duration_minutes) VALUES ('Vaccination', 'Vaccination', 40, 20)");
echo "✓ Services insérés\n";

$conn->close();
echo "\n✓ Toutes les tables sont créées et prêtes!\n";
