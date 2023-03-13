<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KategoriModel;

class TreatmentModel extends Model
{
    
    protected $DBGroup          = 'default';
    protected $table            = 'treatments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
        'nama_treatment', 'kategori_id', 'gambar', 'deskripsi', 'harga', 'durasi'
    ];

    // Dates
    protected $useTimestamps = true;


    public function getAllWithKategori()
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('treatments.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = treatments.kategori_id')
            ->get();

        return $query->getResult();
    }

    public function getIdWithKategori($id = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('treatments.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = treatments.kategori_id')
            ->where('treatments.id', $id)
            ->get();

        return $query->getRow();
    }
}