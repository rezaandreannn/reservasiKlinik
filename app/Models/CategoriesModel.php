<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
        'name', 'description'
    ];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules      = [
        'name'         => 'required',
        'description'         => 'required',
    ];
    protected $validationMessages   = [];



}