<?php
$config = require 'app/Config/Database.php';
$db_config = $config['default'];

$dsn = 'mysql:host=' . $db_config['hostname'] . ';dbname=' . $db_config['database'];
try {
    $pdo = new PDO($dsn, $db_config['username'], $db_config['password']);
    
    echo "=== TABLE admin_users ===\n";
    $result = $pdo->query('SELECT id_admin, email, nom, actif FROM admin_users')->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
        echo json_encode($row) . "\n";
    }
    
    echo "\n=== TABLE email_verifications ===\n";
    $result = $pdo->query('SELECT email, entity_type, verified_at FROM email_verifications')->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
        echo json_encode($row) . "\n";
    }
    
    echo "\n=== TABLE audit_logs ===\n";
    $result = $pdo->query('SELECT email, action, status FROM audit_logs ORDER BY created_at DESC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
        echo json_encode($row) . "\n";
    }
} catch(Exception $e) {
    echo 'Erreur: ' . $e->getMessage();
}
?>
