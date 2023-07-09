<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Controllers\BaseController;

class Report extends BaseController
{

    protected $reservasi, $session;

    public function __construct(){
        $this->reservasi = new ReservasiModel();
        $this->session = service('session');
    }
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
        ];

        return view('backend/report', $data);
    }

    public function cetak()
    {
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');

        $data = [
            'title' => 'Laporan',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'start' => $start_date,
            'end' => $end_date,
            'reservasis' => $this->reservasi->reportByTanggal($start_date, $end_date)
        ];


        return view('backend/report-cetak', $data);
    }
}