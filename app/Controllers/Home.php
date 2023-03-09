<?php

namespace App\Controllers;

use App\Models\BankModel;

class Home extends BaseController
{

    protected $bank;

    public function __construct(){
        $this->bank = new BankModel();
       
    }

    public function index()
    {
        $data = [
            'banks' => $this->bank->where('status', 'aktif')->findAll()
        ];

        return view('landingpage', $data);
    }
}