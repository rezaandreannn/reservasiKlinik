<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Controllers\BaseController;


class UserReservasi extends BaseController
{

    protected $reservasi, $session;

    public function __construct(){
        $this->reservasi = new ReservasiModel();
        $this->session = service('session');
    }

    public function index()
    {

        $data = [
            'title' => 'User Reservasi',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'reservasis' => $this->reservasi->getAll()
        ];

        // var_dump($data['reservasis']);
        // die;
        return view('backend/user-reservasi', $data);
    }

    public function getBayarOnline()
    {
        $data = [
            'title' => 'Pembayaran Online',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'reservasis' => $this->reservasi->getBayarOnline()
        ];

        // var_dump($data['reservasis']);
        // die;
        return view('backend/reservasi/bayar-online', $data);
    }

    public function getBayarOffline()
    {
        $data = [
            'title' => 'Pembayaran Offline',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'reservasis' => $this->reservasi->getBayarOffline()
        ];

        // var_dump($data['reservasis']);
        // die;
        return view('backend/reservasi/bayar-offline', $data);
    }

    public function updateBayarOffline($id = null)
    {

        $data = [
            'status_reservasi' => 'selesai',
            'status_bayar'=> 'lunas'
        ];

        $this->reservasi->update($id, $data); // simpan ke database
         return redirect()->back()->with('message', 'User reservasi Selesai');
    }

    public function delete($id = null){

        $this->reservasi->delete($id);
        return redirect()->back()->with('message', 'Berhasil menghapus reservasi');


    }
}