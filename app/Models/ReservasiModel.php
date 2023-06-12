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
       'kode_reservasi', 'user_id', 'treatment_id','tanggal_reservasi', 'jam_mulai', 'jam_selesai', 'deskripsi', 'status_reservasi'
    ];

    // Dates
    protected $useTimestamps = true;


    public function getAllByTanggal($tanggal = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username')
            ->join('users', 'users.id = reservasi.user_id')
            ->where('tanggal_reservasi', $tanggal)
            ->orderBy('reservasi.jam_mulai', 'asc')
            ->get();

        return $query->getResult();
    }

    public function getTreatmentByUser($userId = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, treatments.nama_treatment')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('user_id', $userId)
            ->where('status_reservasi', 'pending')
            ->where("DATE(tanggal_reservasi) >= CURDATE()")
            ->orderBy('reservasi.tanggal_reservasi', 'asc')
            ->get();

        return $query->getResult();
    }
}