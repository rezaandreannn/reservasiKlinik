<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TreatmentModel;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
        'nama_kategori', 'deskripsi'
    ];

    // Dates
    protected $useTimestamps = true;

   


}