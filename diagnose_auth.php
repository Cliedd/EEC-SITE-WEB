<?php
/**
 * Script de diagnostic complet de l'authentification
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Config/Database.php';

$db = new \Config\Database();
$connection = $db->default;

try {
    $mysqli = new mysqli(
        $connection['hostname'],
        $connection['username'],
        $connection['password'],
        $connection['database']
    );

    if ($mysqli->connect_error) {
        die("Erreur de connexion: " . $mysqli->connect_error);
    }

    echo "=== DIAGNOSTIC D'AUTHENTIFICATION ===\n\n";

    // 1. Vérifier le compte admin
    echo "1. VÉRIFICATION DU COMPTE ADMIN\n";
    echo str_repeat("-", 50) . "\n";
    
    $email = 'adminstrateurcmp@dashboard.com';
    $result = $mysqli->query("SELECT * FROM admin_users WHERE email = '$email'");
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        echo "✓ Compte trouvé\n";
        echo "  ID: " . $admin['id_admin'] . "\n";
        echo "  Email: " . $admin['email'] . "\n";
        echo "  Nom: " . $admin['nom'] . "\n";
        echo "  Actif: " . $admin['actif'] . "\n";
        echo "  Hash MD5: " . substr($admin['mot_de_passe'], 0, 20) . "...\n";
    } else {
        echo "✗ Compte non trouvé\n";
    }

    // 2. Vérifier l'email dans email_verifications
    echo "\n2. VÉRIFICATION EMAIL\n";
    echo str_repeat("-", 50) . "\n";
    
    $result = $mysqli->query("SELECT * FROM email_verifications WHERE email = '$email' AND entity_type = 'admin'");
    
    if ($result->num_rows > 0) {
        $verification = $result->fetch_assoc();
        echo "✓ Email vérifié\n";
        echo "  Email: " . $verification['email'] . "\n";
        echo "  Entity Type: " . $verification['entity_type'] . "\n";
        echo "  Vérifié à: " . $verification['verified_at'] . "\n";
    } else {
        echo "✗ Email non vérifié\n";
    }

    // 3. Tester password_verify
    echo "\n3. TEST DE PASSWORD_VERIFY\n";
    echo str_repeat("-", 50) . "\n";
    
    $testPassword = 'Test@1234';
    if (isset($admin)) {
        $hashFromDb = $admin['mot_de_passe'];
        
        // Vérifier si c'est un hash bcrypt valide
        if (preg_match('/^\$2[aby]\$/', $hashFromDb)) {
            echo "Hash: Bcrypt détecté\n";
            $verify = password_verify($testPassword, $hashFromDb);
            echo "password_verify('$testPassword', hash): " . ($verify ? "✓ VRAI" : "✗ FAUX") . "\n";
        } else {
            echo "Hash: Format non-bcrypt détecté\n";
            echo "Hash: " . $hashFromDb . "\n";
            // Essayer MD5
            if ($hashFromDb === md5($testPassword)) {
                echo "MD5('$testPassword'): ✓ MATCH\n";
            } else {
                echo "MD5('$testPassword'): ✗ NO MATCH\n";
            }
        }
    }

    // 4. Vérifier le hash du mot de passe réinitialisé
    echo "\n4. VÉRIFICATION DU HASH ACTUEL\n";
    echo str_repeat("-", 50) . "\n";
    
    if (isset($admin)) {
        $currentHash = $admin['mot_de_passe'];
        echo "Hash stocké en DB:\n";
        echo $currentHash . "\n\n";
        
        // Créer un nouveau hash avec la même méthode
        $newHash = password_hash($testPassword, PASSWORD_BCRYPT);
        echo "Nouveau hash généré:\n";
        echo $newHash . "\n\n";
        
        // Vérifier
        echo "Vérification:\n";
        echo "password_verify('$testPassword', newHash): " . (password_verify($testPassword, $newHash) ? "✓ VRAI" : "✗ FAUX") . "\n";
    }

    // 5. Vérifier les tentatives de connexion
    echo "\n5. HISTORIQUE DES TENTATIVES DE CONNEXION\n";
    echo str_repeat("-", 50) . "\n";
    
    $result = $mysqli->query("SELECT * FROM audit_logs WHERE user_email = '$email' AND action = 'LOGIN_ATTEMPT' ORDER BY created_at DESC LIMIT 10");
    
    if ($result->num_rows > 0) {
        while ($log = $result->fetch_assoc()) {
            echo "  " . $log['created_at'] . " - " . $log['status'] . " - " . $log['details'] . "\n";
        }
    } else {
        echo "Aucune tentative enregistrée\n";
    }

    // 6. Vérifier les sessions
    echo "\n6. RÉPERTOIRE DES SESSIONS\n";
    echo str_repeat("-", 50) . "\n";
    
    $sessionDir = __DIR__ . '/writable/session';
    if (is_dir($sessionDir)) {
        $files = glob($sessionDir . '/ci_session_*');
        echo "Nombre de fichiers de session: " . count($files) . "\n";
        foreach ($files as $file) {
            echo "  " . basename($file) . " (" . filesize($file) . " bytes)\n";
        }
    } else {
        echo "Répertoire de session non trouvé\n";
    }

    // 7. Vérifier les tables
    echo "\n7. TABLES DE LA BASE DE DONNÉES\n";
    echo str_repeat("-", 50) . "\n";
    
    $tables = ['admin_users', 'email_verifications', 'audit_logs'];
    foreach ($tables as $table) {
        $result = $mysqli->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            echo "✓ $table existe\n";
            $countResult = $mysqli->query("SELECT COUNT(*) as count FROM $table");
            $countRow = $countResult->fetch_assoc();
            echo "  Lignes: " . $countRow['count'] . "\n";
        } else {
            echo "✗ $table n'existe pas\n";
        }
    }

    echo "\n" . str_repeat("=", 50) . "\n";
    echo "FIN DU DIAGNOSTIC\n";

    $mysqli->close();

} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
