<?php

namespace App\Controllers;

use App\Models\BankModel;
use App\Models\TreatmentModel;

class Home extends BaseController
{

    protected $bank, $treatment;

    public function __construct(){
        $this->bank = new BankModel();
        $this->treatment = new TreatmentModel();
       
    }

    public function index()
    {
        $data = [
            'banks' => $this->bank->where('status', 'aktif')->findAll(),
            'treatments' => $this->treatment->getAllWithKategori()
        ];

        return view('frond/beranda', $data);
    }

    public function treatment(){

        return view('frond/treatment');
    }
}