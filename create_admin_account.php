<?php

// Script pour créer le compte admin avec les identifiants spécifiés
echo "🔐 CRÉATION DU COMPTE ADMIN\n";
echo "============================\n\n";

try {
    // Connexion directe à MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=eecbafoussam;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connexion MySQL réussie!\n\n";
    
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
    $stmt = $pdo->prepare("SELECT id_admin FROM admin_users WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing) {
        echo "⚠️ L'utilisateur existe déjà. Mise à jour...\n";
        
        // Mettre à jour
        $stmt = $pdo->prepare("UPDATE admin_users SET 
            mot_de_passe = ?, 
            nom = ?, 
            date_modification = NOW() 
            WHERE email = ?");
        
        $stmt->execute([$mot_de_passe_hash, $nom, $email]);
        
        echo "✅ Utilisateur mis à jour avec succès!\n";
    } else {
        echo "🆕 Création d'un nouvel utilisateur...\n";
        
        // Créer
        $stmt = $pdo->prepare("INSERT INTO admin_users (email, mot_de_passe, nom, date_creation, actif) 
            VALUES (?, ?, ?, NOW(), 1)");
        
        $stmt->execute([$email, $mot_de_passe_hash, $nom]);
        
        echo "✅ Nouvel utilisateur créé avec succès!\n";
    }
    
    // Vérifier la création
    $stmt = $pdo->prepare("SELECT id_admin, email, nom, actif, date_creation FROM admin_users WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "\n📊 INFORMATIONS DU COMPTE:\n";
    echo "============================\n";
    echo "ID: " . $admin['id_admin'] . "\n";
    echo "Email: " . $admin['email'] . "\n";
    echo "Nom: " . $admin['nom'] . "\n";
    echo "Statut: " . ($admin['actif'] ? 'Actif' : 'Inactif') . "\n";
    echo "Créé le: " . $admin['date_creation'] . "\n";
    
    echo "\n✅ COMPTE ADMIN CRÉÉ AVEC SUCCÈS!\n";
    echo "🔑 Vous pouvez maintenant vous connecter avec ces identifiants.\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur MySQL: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
