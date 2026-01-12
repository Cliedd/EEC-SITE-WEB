<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id_visitor';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'idlogin',
        'name_surName',
        'email',
        'telephone',
        'visitor_type',
        'date_visit'
    ];

    protected $useTimestamps = false;
}
