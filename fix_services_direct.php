<?php

// Script de correction directe des services
echo "🏥 CORRECTION DES SERVICES HOSPITALIERS\n";
echo "========================================\n\n";

try {
    // Charger l'environnement CodeIgniter
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
    define('APPPATH', FCPATH . 'app' . DIRECTORY_SEPARATOR);
    
    // Charger l'autoloader
    require_once APPPATH . 'Config/Autoload.php';
    
    $autoload = new \CodeIgniter\Autoload\Autoload();
    $autoload->initialize();
    
    // Charger les vendors
    require_once FCPATH . 'vendor/autoload.php';
    
    // Charger la config
    require_once APPPATH . 'Config/Config.php';
    
    // Bootstrap
    $config = new \App\Config\App();
    new \CodeIgniter\Bootstrap($config);
    
    // Initialiser la base de données
    $db = \Config\Database::connect();
    
    echo "✅ Connexion à la base de données réussie!\n\n";
    
    // 1. Corriger l'encodage de "Consultation"
    echo "🔤 Correction de l'encodage UTF-8...\n";
    
    $stmt = $db->query("UPDATE services SET 
        name = 'Consultation Générale', 
        description = 'Consultation médicale générale pour tous types de problèmes de santé' 
        WHERE name LIKE '%Consultation%'");
    
    echo "   ✅ Service 'Consultation' corrigé\n";
    
    // 2. Supprimer "Visite Domicile"
    echo "🗑️ Suppression de 'Visite Domicile'...\n";
    
    $stmt = $db->query("DELETE FROM services WHERE name LIKE '%Visite%'");
    
    if ($db->affectedRows() > 0) {
        echo "   ✅ Service 'Visite Domicile' supprimé\n";
    } else {
        echo "   ⚠️ Aucun service 'Visite' trouvé\n";
    }
    
    echo "\n";
    
    // 3. Ajouter les services hospitaliers
    echo "🏥 Ajout des services hospitaliers...\n";
    
    $hospitalServices = [
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
    ];
    
    // Vérifier les services existants
    $stmt = $db->query("SELECT name FROM services");
    $existingServices = $stmt->fetchColumn();
    
    $addedCount = 0;
    foreach ($hospitalServices as $service) {
        $name = $service[0];
        $description = $service[1];
        
        // Vérifier si le service existe déjà
        $stmt = $db->prepare("SELECT COUNT(*) FROM services WHERE name = ?");
        $stmt->execute([$name]);
        
        if ($stmt->fetchColumn() == 0) {
            // Ajouter le service
            $stmt = $db->prepare("INSERT INTO services (name, description, is_active, created_at) VALUES (?, ?, 1, NOW())");
            $stmt->execute([$name, $description]);
            
            echo "   ✅ Ajouté: $name\n";
            $addedCount++;
        } else {
            echo "   ⚠️ Existe déjà: $name\n";
        }
    }
    
    echo "\n🎉 $addedCount nouveaux services ajoutés!\n\n";
    
    // 4. Afficher les services finaux
    echo "📋 SERVICES DANS LA BASE DE DONNÉES:\n";
    echo "=====================================\n";
    
    $stmt = $db->query("SELECT id_service, name, is_active FROM services ORDER BY name");
    $services = $stmt->fetchAll();
    
    $totalServices = count($services);
    $activeServices = 0;
    
    foreach ($services as $service) {
        $status = $service['is_active'] ? '✅ Actif' : '❌ Inactif';
        printf("%2d. %-35s %s\n", $service['id_service'], $service['name'], $status);
        if ($service['is_active']) $activeServices++;
    }
    
    echo "\n📊 STATISTIQUES FINALES:\n";
    echo "=========================\n";
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
