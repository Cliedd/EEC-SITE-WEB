<?php

// Script de correction utilisant CodeIgniter 4
echo "🏥 CORRECTION SERVICES HOSPITALIERS - CODEIGNITER 4\n";
echo "===============================================\n\n";

// Charger l'autoloader
require_once __DIR__ . '/app/Config/Autoload.php';

// Utiliser l'autoloader CodeIgniter
$autoload = new \CodeIgniter\Autoload\Autoload();
$autoload->initialize();

// Charger les vendor autoload
require_once __DIR__ . '/vendor/autoload.php';

// Charger la configuration
require_once __DIR__ . '/app/Config/Config.php';

// Bootstrap CodeIgniter
$config = new \App\Config\App();
$bootstrap = new \CodeIgniter\Bootstrap($bootstrap ?? $config);

try {
    // Utiliser le ServiceModel existant
    $serviceModel = new \App\Models\ServiceModel();
    
    echo "✅ ServiceModel CodeIgniter chargé!\n\n";
    
    // 1. Corriger l'encodage
    echo "🔤 Correction de l'encodage UTF-8...\n";
    
    // Récupérer tous les services existants
    $existingServices = $serviceModel->findAll();
    
    foreach ($existingServices as $service) {
        // Corriger "Consultation"
        if (strpos($service['name'], 'Consultation') !== false) {
            $serviceModel->update($service['id_service'], [
                'name' => 'Consultation Générale',
                'description' => 'Consultation médicale générale pour tous types de problèmes de santé'
            ]);
            echo "   ✅ Service corrigé: Consultation Générale\n";
        }
        
        // Supprimer "Visite Domicile"
        if (strpos($service['name'], 'Visite') !== false) {
            $serviceModel->delete($service['id_service']);
            echo "   ✅ Service supprimé: " . $service['name'] . "\n";
        }
    }
    
    echo "\n";
    
    // 2. Ajouter les services hospitaliers
    echo "🏥 Ajout des services hospitaliers...\n";
    
    $hospitalServices = [
        ['name' => 'Pédiatrie/Néonatologie', 'description' => 'Soins médicaux spécialisés pour les enfants et nouveau-nés'],
        ['name' => 'Obstétrique/Gynécologie', 'description' => 'Suivi gynécologique et suivi de grossesse'],
        ['name' => 'Chirurgie générale', 'description' => 'Interventions chirurgicales diverses'],
        ['name' => 'Médecine interne', 'description' => 'Diagnostic et traitement des maladies internes'],
        ['name' => 'Neurologie', 'description' => 'Spécialité des troubles du système nerveux'],
        ['name' => 'Réanimation', 'description' => 'Soins intensifs et réanimation'],
        ['name' => 'Kinésithérapie', 'description' => 'Rééducation physique et motrice'],
        ['name' => 'Nutrition', 'description' => 'Conseil et suivi nutritionnel'],
        ['name' => 'Échographie', 'description' => 'Examens échographiques diagnostiques'],
        ['name' => 'Laboratoire', 'description' => 'Analyses biologiques et médicales'],
        ['name' => 'UPEC', 'description' => 'Unité de Premiers Secours et des Urgences'],
    ];
    
    // Vérifier les services existants
    $allServices = $serviceModel->findAll();
    $existingNames = array_column($allServices, 'name');
    
    $addedCount = 0;
    foreach ($hospitalServices as $service) {
        if (!in_array($service['name'], $existingNames)) {
            $service['is_active'] = 1;
            $service['created_at'] = date('Y-m-d H:i:s');
            
            $serviceModel->insert($service);
            echo "   ✅ Ajouté: " . $service['name'] . "\n";
            $addedCount++;
        } else {
            echo "   ⚠️ Existe déjà: " . $service['name'] . "\n";
        }
    }
    
    echo "\n🎉 $addedCount nouveaux services ajoutés!\n\n";
    
    // 3. Afficher les statistiques finales
    echo "📋 SERVICES FINAUX:\n";
    echo "===================\n";
    
    $finalServices = $serviceModel->orderBy('name')->findAll();
    $totalServices = count($finalServices);
    $activeServices = 0;
    
    foreach ($finalServices as $service) {
        $status = $service['is_active'] ? '✅ Actif' : '❌ Inactif';
        printf("%2d. %-35s %s\n", $service['id_service'], $service['name'], $status);
        if ($service['is_active']) $activeServices++;
    }
    
    echo "\n📊 STATISTIQUES:\n";
    echo "=================\n";
    echo "Total des services: $totalServices\n";
    echo "Services actifs: $activeServices\n";
    echo "Services inactifs: " . ($totalServices - $activeServices) . "\n";
    
    echo "\n✅ CORRECTION TERMINÉE!\n";
    echo "🔄 Rechargez admin/services pour voir les changements.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Fichier: " . $e->getFile() . "\n";
    echo "Ligne: " . $e->getLine() . "\n";
}
