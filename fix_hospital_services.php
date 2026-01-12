<?php

// Script de correction des services hospitaliers
require_once 'app/Config/Autoload.php';

try {
    // Charger les autoloaders
    $loader = new \CodeIgniter\Autoload\Autoload();
    $loader->initialize();
    
    require_once FCPATH . '../vendor/autoload.php';
    require_once APPPATH . 'Config/Config.php';
    
    // Initialiser CodeIgniter
    $config = new \App\Config\App();
    new \CodeIgniter\Bootstrap($config);
    
    // Connexion DB
    $db = \Config\Database::connect();
    
    echo "✅ Connexion réussie!\n\n";
    
    // 1. Supprimer "Visite Domicile"
    echo "🗑️ Suppression du service 'Visite Domicile'...\n";
    $db->query("DELETE FROM services WHERE name LIKE '%Visite Domicile%' OR name LIKE '%Visite%'");
    echo "✅ Service supprimé\n\n";
    
    // 2. Ajouter les services hospitaliers manquants
    echo "🏥 Ajout des services hospitaliers...\n";
    
    $hospitalServices = [
        ['name' => 'Pédiatrie/Néonatologie', 'description' => 'Soins médicaux spécialisés pour les enfants et nouveau-nés', 'is_active' => 1],
        ['name' => 'Obstétrique/Gynécologie', 'description' => 'Suivi gynécologique et suivi de grossesse', 'is_active' => 1],
        ['name' => 'Chirurgie générale', 'description' => 'Interventions chirurgicales diverses', 'is_active' => 1],
        ['name' => 'Médecine interne', 'description' => 'Diagnostic et traitement des maladies internes', 'is_active' => 1],
        ['name' => 'Neurologie', 'description' => 'Spécialité des troubles du système nerveux', 'is_active' => 1],
        ['name' => 'Réanimation', 'description' => 'Soins intensifs et réanimation', 'is_active' => 1],
        ['name' => 'Kinésithérapie', 'description' => 'Rééducation physique et motrice', 'is_active' => 1],
        ['name' => 'Nutrition', 'description' => 'Conseil et suivi nutritionnel', 'is_active' => 1],
        ['name' => 'Échographie', 'description' => 'Examens échographiques diagnostiques', 'is_active' => 1],
        ['name' => 'Laboratoire', 'description' => 'Analyses biologiques et médicales', 'is_active' => 1],
        ['name' => 'UPEC', 'description' => 'Unité de Premiers Secours et des Urgences', 'is_active' => 1],
    ];
    
    // Vérifier les services existants
    $existingServices = $db->table('services')->get()->getResultArray();
    $existingNames = array_column($existingServices, 'name');
    
    $addedCount = 0;
    foreach ($hospitalServices as $service) {
        if (!in_array($service['name'], $existingNames)) {
            $service['created_at'] = date('Y-m-d H:i:s');
            $db->table('services')->insert($service);
            echo "   ✅ Ajouté: " . $service['name'] . "\n";
            $addedCount++;
        } else {
            echo "   ⚠️ Existe déjà: " . $service['name'] . "\n";
        }
    }
    
    echo "\n🎉 $addedCount nouveaux services ajoutés!\n\n";
    
    // 3. Corriger l'encodage UTF-8
    echo "🔤 Correction de l'encodage UTF-8...\n";
    
    // Mettre à jour les services existants avec un meilleur encodage
    $db->query("UPDATE services SET 
        name = CASE 
            WHEN name LIKE '%G%C3%A9n%C3%A9rale%' THEN 'Consultation Générale'
            ELSE name 
        END,
        description = CASE 
            WHEN description LIKE '%Consultation%' THEN 'Consultation médicale générale pour tous types de problèmes de santé'
            ELSE description 
        END
        WHERE name LIKE '%G%C3%A9n%C3%A9rale%' OR description LIKE '%Consultation%'");
    
    echo "✅ Encodage corrigé\n\n";
    
    // 4. Afficher tous les services finaux
    echo "📋 Services dans la base de données finale:\n";
    echo "=====================================\n";
    
    $finalServices = $db->table('services')->orderBy('name')->get()->getResultArray();
    $totalServices = count($finalServices);
    $activeServices = 0;
    
    foreach ($finalServices as $service) {
        $status = $service['is_active'] ? '✅ Actif' : '❌ Inactif';
        echo sprintf("%2d. %-30s %s\n", $service['id_service'], $service['name'], $status);
        if ($service['is_active']) $activeServices++;
    }
    
    echo "\n📊 STATISTIQUES:\n";
    echo "================\n";
    echo "Total des services: $totalServices\n";
    echo "Services actifs: $activeServices\n";
    echo "Services inactifs: " . ($totalServices - $activeServices) . "\n";
    
    echo "\n✅ Correction terminée avec succès!\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
