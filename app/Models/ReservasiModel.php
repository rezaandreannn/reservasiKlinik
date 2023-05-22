<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reservasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
        'user_id', 'treatment_id','tanggal_reservasi', 'jam_mulai', 'jam_selesai', 'deskripsi', 'status_reservasi'
    ];

    // Dates
    protected $useTimestamps = true;

    // // Validation
    // protected $validationRules      = [
    //     'hari_buka'         => 'required',
    //     'jam_buka'         => 'required',
    //     'jam_tutup'         => 'required',
    // ];
    // protected $validationMessages   = [];

    // public function getJadwalByDay($day)
    // {
    //     return $this->where('hari_buka', $day)->first();
    // }

    public function getAllByTanggal($tanggal = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username')
            ->join('users', 'users.id = reservasi.user_id')
            ->where('tanggal_reservasi', $tanggal)
            ->get();

        return $query->getResult();
    }
}