<?php

namespace App\Models;

use CodeIgniter\Model;

class TreatmentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'treatments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
        'nama_treatment', 'kategori', 'gambar', 'deskripsi', 'harga'
    ];

    // Dates
    protected $useTimestamps = true;
}