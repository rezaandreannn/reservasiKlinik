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
}