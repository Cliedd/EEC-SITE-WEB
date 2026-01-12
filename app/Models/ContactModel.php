<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    public function saveData($data)
   {
    
   }
    


    // Validation
    protected $validationRules      = [
        'name-surName' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'telephone'  => 'required|numeric|min_length[10]|max_length[15]',
        'Objet'  => 'required',
        'msg'  => 'required',
    ];

    protected $validationMessages   = [
        'name-surName' => [
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
        'mot-de-passe' => [
            'required' => 'Le mot de passe est obligatoire.',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}