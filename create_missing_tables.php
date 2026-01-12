<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'eecbafoussam');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Créer tables manquantes
$sql_services = 'CREATE TABLE IF NOT EXISTS services (
    id_service INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    duration_minutes INT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)';

$sql_contacts = 'CREATE TABLE IF NOT EXISTS contacts (
    id_contact INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status VARCHAR(50) DEFAULT "unread",
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)';

$sql_accounts = 'CREATE TABLE IF NOT EXISTS accounts (
    id_account INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    status VARCHAR(50) DEFAULT "active",
    email_verified TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)';

$conn->query($sql_services);
$conn->query($sql_contacts);
$conn->query($sql_accounts);

// Insérer les services
$services = [
    ['Consultation Générale', 'Consultation médicale générale', 50.00, 30],
    ['Visite Domicile', 'Visite médicale à domicile', 80.00, 45],
    ['Vaccination', 'Service de vaccination', 40.00, 20],
    ['Examen Dentaire', 'Examen dentaire complet', 60.00, 30],
    ['Suivi Grossesse', 'Suivi de grossesse', 70.00, 40],
];

foreach ($services as $service) {
    $stmt = $conn->prepare('INSERT IGNORE INTO services (name, description, price, duration_minutes) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssdi', $service[0], $service[1], $service[2], $service[3]);
    $stmt->execute();
}

echo "✓ Tables créées et données insérées\n";
$conn->close();
