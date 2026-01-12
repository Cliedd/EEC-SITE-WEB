<?php

require_once 'preload.php';

// Connexion à la base de données
$db = \Config\Database::connect();

try {
    // Services à insérer
    $services = [
        [
            'name' => 'Pédiatrie/Néonatologie',
            'description' => 'Soins médicaux spécialisés pour les enfants et nouveau-nés',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Obstétrique/Gynécologie',
            'description' => 'Suivi gynécologique et suivi de grossesse',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Chirurgie générale',
            'description' => 'Interventions chirurgicales diverses',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Médecine interne',
            'description' => 'Diagnostic et traitement des maladies internes',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Neurologie',
            'description' => 'Spécialité des troubles du système nerveux',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Réanimation',
            'description' => 'Soins intensifs et réanimation',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Kinésithérapie',
            'description' => 'Rééducation physique et motrice',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Nutrition',
            'description' => 'Conseil et suivi nutritionnel',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Échographie',
            'description' => 'Examens échographiques diagnostiques',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Laboratoire',
            'description' => 'Analyses biologiques et médicales',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'UPEC',
            'description' => 'Unité de Premiers Secours et des Urgences',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Vaccination',
            'description' => 'Services de vaccination pour enfants et adultes',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
    ];

    // Vérifier si les services existent déjà
    $existingServices = $db->table('services')->get()->getResultArray();
    $existingNames = array_column($existingServices, 'name');
    
    $newServices = [];
    foreach ($services as $service) {
        if (!in_array($service['name'], $existingNames)) {
            $newServices[] = $service;
        }
    }

    if (!empty($newServices)) {
        $db->table('services')->insertBatch($newServices);
        echo "✅ " . count($newServices) . " nouveaux services ajoutés avec succès!\n";
    } else {
        echo "ℹ️  Tous les services existent déjà dans la base de données.\n";
    }

    // Afficher les services actuels
    $currentServices = $db->table('services')->get()->getResultArray();
    echo "\n📋 Services actuels dans la base de données:\n";
    foreach ($currentServices as $service) {
        echo "  - " . $service['name'] . " (" . ($service['is_active'] ? 'Actif' : 'Inactif') . ")\n";
    }

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
