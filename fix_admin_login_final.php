<?php
/**
 * Script final pour corriger définitivement le problème de connexion admin
 */

echo "=== CORRECTION FINALE - AUTHENTIFICATION ADMIN ===\n\n";

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eecbafoussam';

try {
    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error) {
        die("Erreur connexion: " . $conn->connect_error);
    }

    $email = 'adminstrateurcmp@dashboard.com';
    $password = 'cmpBafoussam237@';

    echo "ÉTAPE 1: Mise à jour du mot de passe admin\n";
    echo "Email: $email\n";
    echo "Nouveau mot de passe: $password\n\n";

    // Créer un nouveau hash
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    echo "Nouveau hash créé: $newHash\n";

    // Mettre à jour le mot de passe
    $stmt = $conn->prepare("UPDATE admin_users SET mot_de_passe = ? WHERE email = ?");
    $stmt->bind_param("ss", $newHash, $email);
    
    if ($stmt->execute()) {
        echo "✓ Mot de passe mis à jour dans admin_users\n\n";
    } else {
        die("✗ Erreur mise à jour: " . $conn->error);
    }

    // Vérifier la mise à jour
    echo "ÉTAPE 2: Vérification du mot de passe\n";
    $result = $conn->query("SELECT mot_de_passe FROM admin_users WHERE email = '$email'");
    $admin = $result->fetch_assoc();
    
    $verify = password_verify($password, $admin['mot_de_passe']);
    echo "Test password_verify: " . ($verify ? "✓ TRUE" : "✗ FALSE") . "\n\n";

    if (!$verify) {
        die("✗ La vérification du mot de passe a échoué!");
    }

    // Vérifier et corriger email_verifications
    echo "ÉTAPE 3: Vérification email\n";
    
    // Supprimer anciennes entrées
    $conn->query("DELETE FROM email_verifications WHERE email = '$email' AND entity_type = 'admin'");
    echo "- Anciennes vérifications supprimées\n";

    // Insérer nouvelle vérification
    $token = bin2hex(random_bytes(32));
    $now = date('Y-m-d H:i:s');
    $expires = date('Y-m-d H:i:s', strtotime('+24 hours'));
    
    $stmt = $conn->prepare("INSERT INTO email_verifications (email, token, entity_type, verified, verified_at, expires_at, created_at) VALUES (?, ?, 'admin', 1, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $token, $now, $expires, $now);
    
    if ($stmt->execute()) {
        echo "✓ Email marqué comme vérifié\n\n";
    } else {
        die("✗ Erreur vérification email: " . $conn->error);
    }

    // Test final de connexion
    echo "ÉTAPE 4: Test final de connexion\n";
    
    // Simuler le processus de connexion
    $query = $conn->query("SELECT * FROM admin_users WHERE email = '$email' AND actif = 1");
    $admin = $query->fetch_assoc();
    
    if (!$admin) {
        die("✗ Admin non trouvé ou inactif\n");
    }
    echo "✓ Admin trouvé: {$admin['nom']}\n";
    
    $passwordOk = password_verify($password, $admin['mot_de_passe']);
    echo "✓ Mot de passe: " . ($passwordOk ? "VALIDE" : "INVALIDE") . "\n";
    
    $verification = $conn->query("SELECT * FROM email_verifications WHERE email = '$email' AND entity_type = 'admin' AND verified_at IS NOT NULL");
    $verif = $verification->fetch_assoc();
    
    if ($verif) {
        echo "✓ Email vérifié: OUI\n";
    } else {
        die("✗ Email non vérifié\n");
    }

    echo "\n=== SUCCÈS ===\n\n";
    echo "Identifiants de connexion:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Email: $email\n";
    echo "Mot de passe: $password\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    echo "Vous pouvez maintenant vous connecter sur:\n";
    echo "http://localhost:9000/auth/login\n\n";
    
    echo "✓ Tous les problèmes sont corrigés!\n";

    $conn->close();

} catch(Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "\n";
}
?>
