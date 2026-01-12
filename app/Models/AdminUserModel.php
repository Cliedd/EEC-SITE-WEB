<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table = 'admin_users';
    protected $primaryKey = 'id_admin';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['email', 'mot_de_passe', 'nom', 'actif', 'date_modification'];

    // Validation Rules
    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[admin_users.email]',
        'mot_de_passe' => 'required|min_length[8]',
        'nom' => 'required|min_length[3]|max_length[100]',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'L\'email est requis',
            'valid_email' => 'Veuillez entrer un email valide',
            'is_unique' => 'Cet email existe déjà',
        ],
        'mot_de_passe' => [
            'required' => 'Le mot de passe est requis',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères',
        ],
        'nom' => [
            'required' => 'Le nom est requis',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Dates
    protected $useTimestamps = false;
    protected $createdField = 'date_creation';
    protected $updatedField = 'date_modification';
    protected $formatDates = true;
    protected $dateFormat = 'datetime';

    /**
     * Vérifier l'authentification d'un administrateur
     */
    public function verifyAdmin($email, $password)
    {
        $admin = $this->where('email', $email)->where('actif', 1)->first();
        
        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            return $admin;
        }
        
        return false;
    }
}
