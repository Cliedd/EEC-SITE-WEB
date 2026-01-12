<?php
// Détails de connexion
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'eecbafoussam';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if($conn->connect_error) {
        die("Connexion failed: " . $conn->connect_error);
    }
    
    // Vérifier s'il y a déjà un admin
    $result = $conn->query("SELECT COUNT(*) as count FROM admin_users");
    $row = $result->fetch_assoc();
    
    echo "Nombre d'admins: " . $row['count'] . "\n\n";
    
    if($row['count'] == 0) {
        echo "Aucun admin trouvé. Création d'un compte admin...\n";
        
        // Créer un hash de mot de passe
        $password = 'admin123456'; // 12 caractères
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        
        $email = 'admin@eecsite.com';
        $nom = 'Administrateur';
        
        // Insérer l'admin
        $sql = "INSERT INTO admin_users (email, mot_de_passe, nom, actif) VALUES (?, ?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $hashed, $nom);
        
        if($stmt->execute()) {
            $admin_id = $conn->insert_id;
            echo "✓ Admin créé avec ID: $admin_id\n";
            echo "  Email: $email\n";
            echo "  Mot de passe: $password\n\n";
            
            // Marquer l'email comme vérifié
            $sql_verify = "INSERT INTO email_verifications (email, entity_type, verified_at) VALUES (?, 'admin', NOW())";
            $stmt_verify = $conn->prepare($sql_verify);
            $stmt_verify->bind_param("s", $email);
            
            if($stmt_verify->execute()) {
                echo "✓ Email marqué comme vérifié\n";
            }
        } else {
            echo "Erreur lors de la création de l'admin: " . $conn->error . "\n";
        }
    } else {
        echo "Admin(s) trouvé(s):\n";
        $result = $conn->query("SELECT id_admin, email, nom FROM admin_users");
        while($row = $result->fetch_assoc()) {
            echo "  ID: " . $row['id_admin'] . " - Email: " . $row['email'] . " - Nom: " . $row['nom'] . "\n";
        }
        
        echo "\nVérification des emails:\n";
        $result = $conn->query("SELECT COUNT(*) as count FROM email_verifications WHERE entity_type='admin'");
        $row = $result->fetch_assoc();
        
        if($row['count'] == 0) {
            echo "Aucun email admin vérifié! Vérification des comptes...\n";
            
            // Marquer tous les emails admin comme vérifiés
            $result = $conn->query("SELECT email FROM admin_users");
            while($row = $result->fetch_assoc()) {
                $email = $row['email'];
                $sql_verify = "INSERT IGNORE INTO email_verifications (email, entity_type, verified_at) VALUES (?, 'admin', NOW())";
                $stmt_verify = $conn->prepare($sql_verify);
                $stmt_verify->bind_param("s", $email);
                if($stmt_verify->execute()) {
                    echo "✓ Email $email vérifié\n";
                }
            }
        } else {
            echo "✓ $row[count] email(s) admin vérifié(s)\n";
        }
    }
    
    $conn->close();
    echo "\nConfiguration complète!\n";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
