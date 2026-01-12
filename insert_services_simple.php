<?php

// Connexion directe à la base de données MySQL
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'eecbafoussam';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connexion à la base de données réussie!\n\n";
    
    // Services à insérer
    $services = [
        ['Pédiatrie/Néonatologie', 'Soins médicaux spécialisés pour les enfants et nouveau-nés'],
        ['Obstétrique/Gynécologie', 'Suivi gynécologique et suivi de grossesse'],
        ['Chirurgie générale', 'Interventions chirurgicales diverses'],
        ['Médecine interne', 'Diagnostic et traitement des maladies internes'],
        ['Neurologie', 'Spécialité des troubles du système nerveux'],
        ['Réanimation', 'Soins intensifs et réanimation'],
        ['Kinésithérapie', 'Rééducation physique et motrice'],
        ['Nutrition', 'Conseil et suivi nutritionnel'],
        ['Échographie', 'Examens échographiques diagnostiques'],
        ['Laboratoire', 'Analyses biologiques et médicales'],
        ['UPEC', 'Unité de Premiers Secours et des Urgences'],
        ['Vaccination', 'Services de vaccination pour enfants et adultes'],
    ];

    $inserted = 0;
    foreach ($services as $service) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO services (name, description, is_active, created_at) VALUES (?, ?, 1, NOW())");
        $stmt->execute([$service[0], $service[1]]);
        if ($stmt->rowCount() > 0) {
            $inserted++;
            echo "✅ Service ajouté: " . $service[0] . "\n";
        }
    }
    
    echo "\n🎉 $inserted nouveaux services ajoutés!\n\n";
    
    // Afficher tous les services
    $stmt = $pdo->query("SELECT name, is_active FROM services ORDER BY name");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "📋 Services dans la base de données:\n";
    foreach ($services as $service) {
        $status = $service['is_active'] ? 'Actif' : 'Inactif';
        echo "  - " . $service['name'] . " ($status)\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Erreur de connexion: " . $e->getMessage() . "\n";
}
