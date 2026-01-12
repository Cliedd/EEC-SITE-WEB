<?php

namespace App\Models;

use CodeIgniter\Model;

class Creer_compteModel extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'idlogin';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name_surName','email','telephone','mot_de_passe'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'Date-creation';
    protected $updatedField  = 'Date-modification';
    protected $deletedField  = 'Date-logout';

    
    // Validation
    protected $validationMessages   = [
        'name_surName' => [
            'required' => 'Le nom est obligatoire.',
            'min_length' => 'Le nom doit contenir au moins 3 caractères.',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères.'
        ],
        'email' => [
            'required' => 'L\'email est obligatoire.',
            'valid_email' => 'Veuillez fournir une adresse email valide.',
            'is_unique' => 'Cet email est déjà utilisé.'
        ],
        'telephone' => [
            'required' => 'Le numéro de téléphone est obligatoire.',
            'numeric' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
            'min_length' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
            'max_length' => 'Le numéro de téléphone ne peut pas dépasser 15 chiffres.'
        ],
        'mot_de_passe' => [
            'required' => 'Le mot de passe est obligatoire.',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = ['hashPassword'];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = ['hashPassword'];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];


}