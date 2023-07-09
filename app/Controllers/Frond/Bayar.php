<?php

namespace App\Controllers\Frond;

use App\Models\ReservasiModel;
use App\Controllers\BaseController;

class Bayar extends BaseController
{

    protected $treatment, $reservasi, $session;

    public function __construct(){
       
        $this->reservasi = new ReservasiModel();
        $this->session = service('session');
       
    }

    public function index($id = null)
    {

        $data = [
            'title' => 'Pembayaran',
            'reservasi' => $this->reservasi->showDetailPembayaran($id),
        ];

        // dd($data['reservasi']);

        return view('frond/bayar', $data);
    }

    public function proses($id = null)
    {
        $rules = [
            'bukti_bayar' => [
                'label' => 'Bukti Bayar',
                'rules' => 'mime_in[bukti_bayar,image/jpg,image/jpeg,image/png]|max_size[bukti_bayar,4096]',
                'errors' => [
                    'mime_in'  => 'Jenis file harus (jpg,jpeg,png)',
                    'max_size' => 'Maksimal 4 Mb'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // $data = $this->request->getPost(); //ambil inputan post
        // simpan gambar
        $upload = $this->request->getFile('bukti_bayar');

     if($upload->getError() == 4){
     }else{
         $upload->move(WRITEPATH . '../public/images/pembayaran');
         $data = [
            'bukti_bayar' => $upload->getName()
         ];
     }
    $this->reservasi->update($id , $data); // simpan ke database

    return redirect()->to(base_url('/reservasi-saya'))->with('message', 'Berhasil mengunggah bukti pembayaran');
    }
}