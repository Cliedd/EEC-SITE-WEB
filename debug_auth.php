<?php
// Lire la config directement
$file = file_get_contents('app/Config/Database.php');
preg_match("/\['hostname'\]\s*=\s*['\"]([^'\"]+)['\"]/", $file, $m1);
preg_match("/\['username'\]\s*=\s*['\"]([^'\"]+)['\"]/", $file, $m2);
preg_match("/\['password'\]\s*=\s*['\"]([^'\"]+)['\"]/", $file, $m3);
preg_match("/\['database'\]\s*=\s*['\"]([^'\"]+)['\"]/", $file, $m4);

$host = $m1[1] ?? 'localhost';
$user = $m2[1] ?? '';
$pass = $m3[1] ?? '';
$db = $m4[1] ?? '';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if($conn->connect_error) {
        die("Connexion failed: " . $conn->connect_error);
    }
    
    echo "=== admin_users ===\n";
    $result = $conn->query("SELECT id_admin, email, nom, actif FROM admin_users");
    while($row = $result->fetch_assoc()) {
        echo json_encode($row) . "\n";
    }
    
    echo "\n=== email_verifications ===\n";
    $result = $conn->query("SELECT email, entity_type, verified_at FROM email_verifications WHERE entity_type='admin'");
    while($row = $result->fetch_assoc()) {
        echo json_encode($row) . "\n";
    }
    
    echo "\n=== Last failed logins ===\n";
    $result = $conn->query("SELECT user_email, status, details, created_at FROM audit_logs WHERE action='LOGIN_ATTEMPT' AND status='failed' ORDER BY created_at DESC LIMIT 5");
    while($row = $result->fetch_assoc()) {
        echo json_encode($row) . "\n";
    }
    
    $conn->close();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
