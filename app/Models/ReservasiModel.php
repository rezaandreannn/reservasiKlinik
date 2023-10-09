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
       'kode_reservasi', 'user_id', 'treatment_id','tanggal_reservasi', 'jam_mulai', 'jam_selesai', 'deskripsi', 'status_reservasi', 'type_pembayaran', 'bank_id', 'jumlah_bayar', 'bukti_bayar', 'status_bayar'
    ];

    // Dates
    protected $useTimestamps = true;

    public function getAll()
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username, treatments.nama_treatment')
            ->join('users', 'users.id = reservasi.user_id')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->orderBy('reservasi.id', 'desc')
            ->get();

        return $query->getResult();
    }

    public function getBayarOffline()
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username, treatments.nama_treatment')
            ->join('users', 'users.id = reservasi.user_id')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('type_pembayaran', 'bayar offline')
            ->orderBy('reservasi.id', 'desc')
            ->get();

        return $query->getResult();
    }

    public function getBayarOnline()
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username, treatments.nama_treatment, bank.kode_bank')
            ->join('users', 'users.id = reservasi.user_id')
            ->join('bank', 'bank.id = reservasi.bank_id')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('type_pembayaran', 'bayar online')
            ->orderBy('reservasi.id', 'desc')
            ->get();

        return $query->getResult();
    }


    public function getAllByTanggal($tanggal = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username, treatments.nama_treatment')
            ->join('users', 'users.id = reservasi.user_id')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('tanggal_reservasi', $tanggal)
            ->where('status_reservasi', 'pending')
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

    public function getTreatmentByUserHistori($userId = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, treatments.nama_treatment')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('user_id', $userId)
            ->where("status_reservasi", 'selesai')
            ->orderBy('reservasi.tanggal_reservasi', 'asc')
            ->get();

        return $query->getResult();
    }

    public function getReservasiFailed()
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('*')
            ->where("status_reservasi", 'pending')
            ->where("DATE(tanggal_reservasi) <= CURDATE()")
            ->get();

        return $query->getResult();
    }

    public function showDetailPembayaran($id = null)
    {
      
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username, treatments.nama_treatment, bank.kode_bank, bank.no_rekening')
            ->join('users', 'users.id = reservasi.user_id')
            ->join('bank', 'bank.id = reservasi.bank_id')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('reservasi.id', $id)
            ->get();
           

        return $query->getRow();
    }

    public function reportByTanggal($start_date = null, $end_date = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table($this->table)
            ->select('reservasi.*, users.username, treatments.nama_treatment, bank.kode_bank, bank.no_rekening')
            ->join('users', 'users.id = reservasi.user_id')
            ->join('bank', 'bank.id = reservasi.bank_id')
            ->join('treatments', 'treatments.id = reservasi.treatment_id')
            ->where('reservasi.tanggal_reservasi BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')
            ->get();

        return $query->getResult();
    }
}