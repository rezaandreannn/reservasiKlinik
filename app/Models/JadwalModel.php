<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
        'hari_buka', 'jam_buka', 'jam_tutup'
    ];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules      = [
        'hari_buka'         => 'required',
        'jam_buka'         => 'required',
        'jam_tutup'         => 'required',
    ];
    protected $validationMessages   = [];
}