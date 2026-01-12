<?php

// Script de mise à jour des services hospitaliers
echo "🏥 MISE À JOUR DES SERVICES HOSPITALIERS\n";
echo "===========================================\n\n";

try {
    // Connexion directe à MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=eecbafoussam;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connexion MySQL réussie!\n\n";
    
    // 1. Corriger l'encodage de "Consultation Générale"
    echo "🔤 Correction de l'encodage UTF-8...\n";
    
    $stmt = $pdo->prepare("UPDATE services SET name = 'Consultation Générale', description = 'Consultation médicale générale pour tous types de problèmes de santé' WHERE name LIKE '%Consultation%'");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "   ✅ Nom corrigé en: Consultation Générale\n";
    } else {
        echo "   ⚠️ Aucune correction effectuée\n";
    }
    
    echo "\n";
    
    // 2. Supprimer "Visite Domicile"
    echo "🗑️ Suppression de 'Visite Domicile'...\n";
    
    $stmt = $pdo->prepare("DELETE FROM services WHERE name LIKE '%Visite Domicile%' OR name LIKE '%Visite%'");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "   ✅ Service(s) supprimé(s)\n";
    } else {
        echo "   ℹ️ Aucun service 'Visite' trouvé\n";
    }
    
    echo "\n";
    
    // 3. Liste des services hospitaliers à ajouter
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
    $stmt = $pdo->query("SELECT name FROM services");
    $existingServices = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $addedCount = 0;
    foreach ($hospitalServices as $service) {
        if (!in_array($service['name'], $existingServices)) {
            $stmt = $pdo->prepare("INSERT INTO services (name, description, is_active, created_at) VALUES (?, ?, 1, NOW())");
            $stmt->execute([$service['name'], $service['description']]);
            
            echo "   ✅ Ajouté: " . $service['name'] . "\n";
            $addedCount++;
        } else {
            echo "   ⚠️ Existe déjà: " . $service['name'] . "\n";
        }
    }
    
    echo "\n🎉 $addedCount nouveaux services ajoutés!\n\n";
    
    // 4. Afficher tous les services finaux
    echo "📋 SERVICES DANS LA BASE DE DONNÉES:\n";
    echo "====================================\n";
    
    $stmt = $pdo->query("SELECT id_service, name, is_active FROM services ORDER BY name");
    $finalServices = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $totalServices = count($finalServices);
    $activeServices = 0;
    
    foreach ($finalServices as $service) {
        $status = $service['is_active'] ? '✅ Actif' : '❌ Inactif';
        printf("%2d. %-35s %s\n", $service['id_service'], $service['name'], $status);
        if ($service['is_active']) $activeServices++;
    }
    
    echo "\n📊 STATISTIQUES FINALES:\n";
    echo "=========================\n";
    echo "Total des services: $totalServices\n";
    echo "Services actifs: $activeServices\n";
    echo "Services inactifs: " . ($totalServices - $activeServices) . "\n";
    
    echo "\n✅ MISE À JOUR TERMINÉE!\n";
    echo "🔄 Rechargez la page admin/services pour voir les changements.\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur MySQL: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
