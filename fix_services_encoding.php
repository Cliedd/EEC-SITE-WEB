<?php

// Script de correction simple des services avec UTF-8
require_once 'app/Config/Autoload.php';

try {
    // Initialiser l'autoloader CodeIgniter
    $loader = new \CodeIgniter\Autoload\Autoload();
    $loader->initialize();
    
    // Charger les dépendances
    require_once FCPATH . '../vendor/autoload.php';
    require_once APPPATH . 'Config/Config.php';
    
    // Bootstrap CodeIgniter
    $config = new \App\Config\App();
    new \CodeIgniter\Bootstrap($config);
    
    // Utiliser le ServiceModel existant
    $serviceModel = new \App\Models\ServiceModel();
    
    echo "✅ ServiceModel chargé avec succès!\n\n";
    
    // 1. Corriger l'encodage de "Consultation Générale"
    echo "🔤 Correction de l'encodage UTF-8...\n";
    
    // Récupérer le service Consultation
    $consultation = $serviceModel->where('name', 'LIKE', '%Consultation%')->first();
    
    if ($consultation) {
        echo "   📝 Service trouvé: " . $consultation['name'] . "\n";
        
        // Corriger l'encodage
        $updateData = [
            'name' => 'Consultation Générale',
            'description' => 'Consultation médicale générale pour tous types de problèmes de santé'
        ];
        
        $serviceModel->update($consultation['id_service'], $updateData);
        echo "   ✅ Nom corrigé en: Consultation Générale\n";
        echo "   ✅ Description mise à jour\n";
    } else {
        echo "   ⚠️ Service Consultation non trouvé\n";
    }
    
    echo "\n";
    
    // 2. Supprimer "Visite Domicile" s'il existe
    echo "🗑️ Suppression de 'Visite Domicile'...\n";
    
    $visiteService = $serviceModel->where('name', 'LIKE', '%Visite%')->first();
    if ($visiteService) {
        $serviceModel->delete($visiteService['id_service']);
        echo "   ✅ Service supprimé: " . $visiteService['name'] . "\n";
    } else {
        echo "   ℹ️ Aucun service 'Visite' trouvé\n";
    }
    
    echo "\n";
    
    // 3. Ajouter les services hospitaliers manquants
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
    
    // 4. Afficher tous les services finaux
    echo "📋 Services dans la base de données finale:\n";
    echo "=====================================\n";
    
    $finalServices = $serviceModel->orderBy('name')->findAll();
    $totalServices = count($finalServices);
    $activeServices = 0;
    
    foreach ($finalServices as $service) {
        $status = $service['is_active'] ? '✅ Actif' : '❌ Inactif';
        echo sprintf("%2d. %-35s %s\n", $service['id_service'], $service['name'], $status);
        if ($service['is_active']) $activeServices++;
    }
    
    echo "\n📊 STATISTIQUES FINALES:\n";
    echo "=========================\n";
    echo "Total des services: $totalServices\n";
    echo "Services actifs: $activeServices\n";
    echo "Services inactifs: " . ($totalServices - $activeServices) . "\n";
    
    echo "\n✅ Correction terminée avec succès!\n";
    echo "🔄 Rechargez la page admin/services pour voir les changements.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Fichier: " . $e->getFile() . "\n";
    echo "Ligne: " . $e->getLine() . "\n";
}
