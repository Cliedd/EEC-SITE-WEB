<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'eecbafoussam');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    echo "❌ Erreur de connexion: " . $conn->connect_error . "\n";
    exit(1);
}

// Vérifier la table admin_users
$result = $conn->query("SELECT * FROM admin_users");
if ($result && $result->num_rows > 0) {
    echo "✓ Table admin_users OK\n";
    while ($row = $result->fetch_assoc()) {
        echo "  - Email: " . $row['email'] . " | Nom: " . $row['nom'] . " | Actif: " . $row['actif'] . "\n";
    }
} else {
    echo "❌ Table admin_users vide ou n'existe pas\n";
}

// Vérifier email_verifications
$result = $conn->query("SELECT * FROM email_verifications");
if ($result && $result->num_rows > 0) {
    echo "\n✓ Table email_verifications OK\n";
    while ($row = $result->fetch_assoc()) {
        echo "  - Email: " . $row['email'] . " | Vérifié: " . $row['verified_at'] . "\n";
    }
}

// Vérifier les autres tables
$tables = ['visitors', 'appointments', 'accounts', 'services', 'contacts', 'audit_logs'];
echo "\n=== État des tables ===\n";
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    echo ($result->num_rows > 0) ? "✓ " : "❌ ";
    echo ucfirst($table) . "\n";
}

$conn->close();
