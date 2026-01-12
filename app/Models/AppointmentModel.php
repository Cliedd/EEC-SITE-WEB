<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id_appointment';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'idlogin',
        'name_surName',
        'email',
        'telephone',
        'date_appointment',
        'service',
        'raison',
        'status',
        'date_creation',
        'date_modification'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'date_creation';
    protected $updatedField = 'date_modification';

    protected $validationRules = [
        'name_surName' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email',
        'telephone' => 'required|numeric|min_length[10]|max_length[20]',
        'date_appointment' => 'required',
        'raison' => 'permit_empty|string',
    ];

    protected $validationMessages = [
        'name_surName' => [
            'required' => 'Le nom est obligatoire.',
            'min_length' => 'Le nom doit contenir au moins 3 caractères.',
        ],
        'email' => [
            'required' => 'L\'email est obligatoire.',
            'valid_email' => 'L\'email doit être valide.',
        ],
        'telephone' => [
            'required' => 'Le téléphone est obligatoire.',
            'numeric' => 'Le téléphone doit contenir des chiffres.',
        ],
        'date_appointment' => [
            'required' => 'La date du rendez-vous est obligatoire.',
        ],
    ];
}
