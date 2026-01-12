<?php

// Script d'authentification admin avec CodeIgniter 4
echo "🔐 MISE EN PLACE AUTHENTIFICATION ADMIN\n";
echo "=========================================\n\n";

try {
    // Charger l'environnement CodeIgniter
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
    define('APPPATH', FCPATH . 'app' . DIRECTORY_SEPARATOR);
    
    // Autoloader CodeIgniter
    require_once APPPATH . 'Config/Autoload.php';
    $autoload = new \CodeIgniter\Autoload\Autoload();
    $autoload->initialize();
    
    // Vendor autoload
    require_once FCPATH . 'vendor/autoload.php';
    
    // Config
    require_once APPPATH . 'Config/Config.php';
    
    // Bootstrap
    $config = new \App\Config\App();
    new \CodeIgniter\Bootstrap($config);
    
    // Base de données
    $db = \Config\Database::connect();
    
    echo "✅ CodeIgniter initialisé!\n\n";
    
    // Identifiants spécifiés
    $email = 'administrationeecc@dashboard.com';
    $mot_de_passe = 'bafoussameec2026@web';
    $nom = 'Administrateur EEC Dashboard';
    
    // Hasher le mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    
    echo "📧 Email: $email\n";
    echo "🔒 Mot de passe: $mot_de_passe\n";
    echo "👤 Nom: $nom\n\n";
    
    // Vérifier si l'utilisateur existe déjà
    $stmt = $db->prepare("SELECT id_admin FROM admin_users WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        echo "⚠️ L'utilisateur existe déjà. Mise à jour...\n";
        
        // Mettre à jour
        $stmt = $db->prepare("UPDATE admin_users SET 
            mot_de_passe = ?, 
            nom = ?, 
            date_modification = NOW() 
            WHERE email = ?");
        
        $stmt->execute([$mot_de_passe_hash, $nom, $email]);
        
        echo "✅ Utilisateur mis à jour avec succès!\n";
    } else {
        echo "🆕 Création d'un nouvel utilisateur...\n";
        
        // Créer
        $stmt = $db->prepare("INSERT INTO admin_users (email, mot_de_passe, nom, date_creation, actif) 
            VALUES (?, ?, ?, NOW(), 1)");
        
        $stmt->execute([$email, $mot_de_passe_hash, $nom]);
        
        echo "✅ Nouvel utilisateur créé avec succès!\n";
    }
    
    // Vérifier la création
    $stmt = $db->prepare("SELECT id_admin, email, nom, actif, date_creation FROM admin_users WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    
    echo "\n📊 INFORMATIONS DU COMPTE:\n";
    echo "============================\n";
    echo "ID: " . $admin['id_admin'] . "\n";
    echo "Email: " . $admin['email'] . "\n";
    echo "Nom: " . $admin['nom'] . "\n";
    echo "Statut: " . ($admin['actif'] ? 'Actif' : 'Inactif') . "\n";
    echo "Créé le: " . $admin['date_creation'] . "\n";
    
    echo "\n✅ COMPTE ADMIN CRÉÉ AVEC SUCCÈS!\n";
    echo "🔑 Vous pouvez maintenant vous connecter avec ces identifiants.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Fichier: " . $e->getFile() . "\n";
    echo "Ligne: " . $e->getLine() . "\n";
}
