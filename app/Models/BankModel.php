<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bank';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
       'kode_bank', 'nama_bank', 'no_rekening', 'logo_bank', 'status'
    ];

    // Dates
    protected $useTimestamps = true;

}