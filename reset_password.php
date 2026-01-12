<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eecbafoussam';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if($conn->connect_error) {
        die("Connexion failed: " . $conn->connect_error);
    }
    
    // Nouveau mot de passe simple
    $new_password = 'Test@1234';
    $hashed = password_hash($new_password, PASSWORD_BCRYPT);
    $email = 'adminstrateurcmp@dashboard.com';
    
    // Mettre à jour le mot de passe
    $sql = "UPDATE admin_users SET mot_de_passe = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed, $email);
    
    if($stmt->execute()) {
        echo "✓ Mot de passe réinitialisé!\n";
        echo "\nCredentials:\n";
        echo "Email: " . $email . "\n";
        echo "Mot de passe: " . $new_password . "\n";
    } else {
        echo "Erreur: " . $conn->error . "\n";
    }
    
    // Vérifier l'état du compte
    echo "\n=== État du compte ===\n";
    $result = $conn->query("SELECT id_admin, email, nom, actif FROM admin_users WHERE email = '$email'");
    $row = $result->fetch_assoc();
    echo json_encode($row) . "\n";
    
    // Vérifier la vérification email
    echo "\n=== Vérification email ===\n";
    $result = $conn->query("SELECT email, entity_type, verified_at FROM email_verifications WHERE email = '$email'");
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row) . "\n";
    } else {
        echo "Email non vérifié! Vérification...\n";
        $sql_verify = "INSERT INTO email_verifications (email, entity_type, verified_at) VALUES (?, 'admin', NOW())";
        $stmt_verify = $conn->prepare($sql_verify);
        $stmt_verify->bind_param("s", $email);
        if($stmt_verify->execute()) {
            echo "✓ Email marqué comme vérifié\n";
        }
    }
    
    // Vérifier les tentatives échouées
    echo "\n=== Dernières tentatives de connexion ===\n";
    $result = $conn->query("SELECT user_email, status, details, created_at FROM audit_logs WHERE action='LOGIN_ATTEMPT' AND user_email = '$email' ORDER BY created_at DESC LIMIT 5");
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode($row) . "\n";
        }
    } else {
        echo "Aucune tentative enregistrée\n";
    }
    
    $conn->close();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
