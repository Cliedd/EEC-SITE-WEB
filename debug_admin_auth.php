<?php
// Script de debug pour l'authentification admin
echo "=== DEBUG AUTHENTIFICATION ADMIN ===\n\n";

// Connexion DB
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eecbafoussam';

try {
    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error) {
        die("Erreur connexion DB: " . $conn->connect_error);
    }

    // Vérifier la table admin_users
    echo "1. CONTENU TABLE admin_users:\n";
    $result = $conn->query("SELECT * FROM admin_users");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: {$row['id_admin']}\n";
            echo "Email: {$row['email']}\n";
            echo "Nom: {$row['nom']}\n";
            echo "Mot de passe hash: {$row['mot_de_passe']}\n";
            echo "Actif: {$row['actif']}\n";
            echo "Date création: {$row['date_creation']}\n\n";
        }
    } else {
        echo "AUCUN ADMIN TROUVÉ!\n\n";
    }

    // Tester le mot de passe
    echo "2. TEST MOT DE PASSE:\n";
    $email = 'adminstrateurcmp@dashboard.com';
    $password = 'cmpBafoussam237@';

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE email = ? AND actif = 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        echo "Admin trouvé: {$admin['email']}\n";
        echo "Hash en DB: {$admin['mot_de_passe']}\n";

        $verify = password_verify($password, $admin['mot_de_passe']);
        echo "Vérification password_verify(): " . ($verify ? 'TRUE' : 'FALSE') . "\n";

        if (!$verify) {
            // Essayer de recréer le hash
            echo "\n3. TENTATIVE RECRÉATION HASH:\n";
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            echo "Nouveau hash: $newHash\n";

            $update = $conn->prepare("UPDATE admin_users SET mot_de_passe = ? WHERE email = ?");
            $update->bind_param("ss", $newHash, $email);
            if ($update->execute()) {
                echo "✓ Hash mis à jour!\n";

                // Re-tester
                $verify2 = password_verify($password, $newHash);
                echo "Nouvelle vérification: " . ($verify2 ? 'TRUE' : 'FALSE') . "\n";
            }
        }
    } else {
        echo "Admin NON trouvé avec email: $email\n";
    }

    // Vérifier les tables nécessaires
    echo "\n4. VÉRIFICATION TABLES:\n";
    $tables = ['admin_users', 'email_verifications', 'audit_logs'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        echo "Table '$table': " . ($result->num_rows > 0 ? 'EXISTS' : 'MISSING') . "\n";
    }

    $conn->close();

} catch(Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "\n";
}

echo "\n=== FIN DEBUG ===\n";
?>
