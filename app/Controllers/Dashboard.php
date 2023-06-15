<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $reservasi, $session;

    public function __construct(){
        $this->reservasi = new ReservasiModel();
        $this->session = service('session');
    }


    public function index()
    {
        $countAll = $this->reservasi
                        ->where('tanggal_reservasi', date('Y-m-d'))
                        ->countAllResults();  

        $countPending = $this->reservasi
                        ->where('status_reservasi', 'pending')
                        ->where('tanggal_reservasi', date('Y-m-d'))
                        ->countAllResults();   

        $countSelesai = $this->reservasi
                        ->where('status_reservasi', 'selesai')
                        ->where('tanggal_reservasi', date('Y-m-d'))
                        ->countAllResults();  

        $countBatal = $this->reservasi
                        ->where('status_reservasi', 'batal')
                        ->where('tanggal_reservasi', date('Y-m-d'))
                        ->countAllResults();           

        $data = [
            'title' => 'Dashboard',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'reservasis' => $this->reservasi->getAllByTanggal(date('Y-m-d')),
            'countAll' => $countAll,
            'countPending' => $countPending,
            'countSelesai' => $countSelesai,
            'countBatal' => $countBatal
        ];

        
        return view('backend/dashboard', $data);
    }
}