<?php

namespace App\Controllers\Frond;

use App\Models\TreatmentModel;
use App\Controllers\BaseController;

class Treatment extends BaseController
{
    protected  $treatment;

    public function __construct(){
       
        $this->treatment = new TreatmentModel();
       
    }
    public function index()
    {
        $data = [
            'title' => 'Treatment',
            'treatments' => $this->treatment->getAllWithKategori()
        ];

        return view('frond/treatment', $data);
    }
}