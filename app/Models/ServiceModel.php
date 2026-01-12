<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id_service';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'description', 'is_active'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
        'is_active' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Le nom du service est requis',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 255 caractères',
        ],
        'is_active' => [
            'required' => 'Le statut de disponibilité est requis',
            'in_list' => 'Le statut doit être 0 ou 1',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Récupérer tous les services disponibles
     */
    public function getAvailableServices()
    {
        return $this->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Récupérer tous les services (disponibles et indisponibles)
     */
    public function getAllServices()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    /**
     * Basculer la disponibilité d'un service
     */
    public function toggleAvailability($serviceId)
    {
        $service = $this->find($serviceId);
        
        if (!$service) {
            return false;
        }

        $newStatus = $service['is_active'] ? 0 : 1;
        return $this->update($serviceId, ['is_active' => $newStatus]);
    }

    /**
     * Activer un service
     */
    public function enableService($serviceId)
    {
        return $this->update($serviceId, ['is_active' => 1]);
    }

    /**
     * Désactiver un service
     */
    public function disableService($serviceId)
    {
        return $this->update($serviceId, ['is_active' => 0]);
    }

    /**
     * Vérifier si un service est disponible
     */
    public function isServiceAvailable($serviceName)
    {
        $service = $this->where('name', $serviceName)
                        ->where('is_active', 1)
                        ->first();
        
        return !empty($service);
    }

    /**
     * Obtenir les services pour un select (nom => nom)
     */
    public function getServicesForSelect()
    {
        $services = $this->getAvailableServices();
        $options = ['' => '-- Sélectionner un service --'];
        
        foreach ($services as $service) {
            $options[$service['name']] = $service['name'];
        }
        
        return $options;
    }

    /**
     * Obtenir les statistiques des services
     */
    public function getServiceStats()
    {
        $total = $this->countAll();
        $available = $this->where('is_active', 1)->countAllResults();
        $unavailable = $total - $available;

        return [
            'total' => $total,
            'available' => $available,
            'unavailable' => $unavailable,
        ];
    }

    /**
     * Normaliser les noms de services pour correspondre à la base de données existante
     */
    public function normalizeServiceName($serviceName)
    {
        $mapping = [
            'Consultation générale' => 'Consultation Générale',
            'Pédiatrie/Néonatologie' => 'Pédiatrie',
            'Obstétrique/Gynécologie' => 'Gynécologie',
            'Chirurgie générale' => 'Chirurgie',
            'Médecine interne' => 'Médecine Interne',
            'Neurologie' => 'Neurologie',
            'Réanimation' => 'Réanimation',
            'Kinésithérapie' => 'Kinésithérapie',
            'Nutrition' => 'Nutrition',
            'Échographie' => 'Échographie',
            'Laboratoire' => 'Laboratoire',
            'UPEC' => 'Urgences',
            'Vaccination' => 'Vaccination',
        ];

        return $mapping[$serviceName] ?? $serviceName;
    }

    /**
     * Insérer les services par défaut si la table est vide
     */
    public function insertDefaultServices()
    {
        if ($this->countAll() == 0) {
            $defaultServices = [
                [
                    'name' => 'Consultation Générale',
                    'description' => 'Consultation médicale générale pour tous types de problèmes de santé',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Pédiatrie',
                    'description' => 'Soins médicaux spécialisés pour les enfants et nouveau-nés',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Gynécologie',
                    'description' => 'Suivi gynécologique et suivi de grossesse',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Chirurgie',
                    'description' => 'Interventions chirurgicales diverses',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Médecine Interne',
                    'description' => 'Diagnostic et traitement des maladies internes',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Neurologie',
                    'description' => 'Spécialité des troubles du système nerveux',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Réanimation',
                    'description' => 'Soins intensifs et réanimation',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Kinésithérapie',
                    'description' => 'Rééducation physique et motrice',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Nutrition',
                    'description' => 'Conseil et suivi nutritionnel',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Échographie',
                    'description' => 'Examens échographiques diagnostiques',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Laboratoire',
                    'description' => 'Analyses biologiques et médicales',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Urgences',
                    'description' => 'Unité de Premiers Secours et des Urgences',
                    'is_active' => 1,
                ],
                [
                    'name' => 'Vaccination',
                    'description' => 'Services de vaccination pour enfants et adultes',
                    'is_active' => 1,
                ],
            ];

            return $this->insertBatch($defaultServices);
        }
        
        return true;
    }
}
