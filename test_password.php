<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'eecbafoussam');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    echo "❌ Erreur de connexion\n";
    exit(1);
}

echo "=== Vérification des hashs de mot de passe ===\n\n";

$result = $conn->query("SELECT id_admin, email, mot_de_passe FROM admin_users");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Admin ID: " . $row['id_admin'] . "\n";
        echo "Email: " . $row['email'] . "\n";
        echo "Hash (premiers 30 chars): " . substr($row['mot_de_passe'], 0, 30) . "\n";
        
        // Tester différents mots de passe
        echo "Test - Test@1234: " . (password_verify('Test@1234', $row['mot_de_passe']) ? '✓ OUI' : '❌ NON') . "\n";
        echo "Test - Admin@123456: " . (password_verify('Admin@123456', $row['mot_de_passe']) ? '✓ OUI' : '❌ NON') . "\n";
        
        // Créer un nouveau hash pour comparaison
        $test_hash = password_hash('TestPassword123', PASSWORD_BCRYPT);
        echo "Hash de test créé: " . substr($test_hash, 0, 30) . "\n";
        echo "Test - TestPassword123 sur nouveau hash: " . (password_verify('TestPassword123', $test_hash) ? '✓ OUI' : '❌ NON') . "\n";
        
        echo "\n";
    }
} else {
    echo "❌ Aucun admin trouvé\n";
}

$conn->close();
