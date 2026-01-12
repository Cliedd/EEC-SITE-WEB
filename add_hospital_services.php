<?php

require_once 'app/Config/Autoload.php';

$loader = new \CodeIgniter\Autoload\Autoload();
$loader->initialize();

require_once FCPATH . '../vendor/autoload.php';
require_once APPPATH . 'Config/Config.php';

$config = new \App\Config\App();
new \CodeIgniter\Bootstrap($config);

$db = \Config\Database::connect();

echo "✅ Connexion CodeIgniter réussie!\n\n";

try {
    // Services à ajouter (les existants sont Consultation, Visite Domicile, Vaccination)
    $newServices = [
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
    ];

    // Vérifier quels services existent déjà
    $existingServices = $db->table('services')->get()->getResultArray();
    $existingNames = array_column($existingServices, 'name');
    
    $servicesToAdd = [];
    foreach ($newServices as $service) {
        if (!in_array($service['name'], $existingNames)) {
            $servicesToAdd[] = $service;
        }
    }

    if (!empty($servicesToAdd)) {
        $db->table('services')->insertBatch($servicesToAdd);
        echo "✅ " . count($servicesToAdd) . " nouveaux services ajoutés avec succès!\n";
        
        foreach ($servicesToAdd as $service) {
            echo "   - " . $service['name'] . "\n";
        }
    } else {
        echo "ℹ️  Tous les services existent déjà.\n";
    }

    echo "\n📋 Tous les services dans la base:\n";
    $allServices = $db->table('services')->orderBy('name')->get()->getResultArray();
    foreach ($allServices as $service) {
        $status = $service['is_active'] ? 'Actif' : 'Inactif';
        echo "   " . ($service['id_service'] ?? '?') . ". " . $service['name'] . " ($status)\n";
    }

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
