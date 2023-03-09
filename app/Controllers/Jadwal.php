<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Controllers\BaseController;

class Jadwal extends BaseController
{

    protected $jadwal, $session;

    public function __construct(){
        $this->jadwal = new JadwalModel();
        $this->session = service('session');
    }


    public function index()
    {

        $data = [
            'title' => 'Jadwal',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'jadwals' => $this->jadwal->findAll()
        ];

       return view('backend/jadwal/index', $data); 
    }

    public function new(){

        $data = [
            'title' => 'Jadwal',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'jadwals' => $this->jadwal->findAll(),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        ];

       return view('backend/jadwal/create', $data); 
    }

    public function create(){

        $rules = [
            'hari_buka' => [
                'label' => 'Hari Buka',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'jam_buka' => [
                'label' => 'Jam Buka',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'jam_tutup' => [
                'label' => 'Jam Tutup',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->jadwal->insert($data); // simpan ke database

    return redirect()->to(base_url('masterdata/jadwal'))->with('message', 'Berhasil membuat jadwal');
    }

    public function edit($id = null){

        $data = [
            'title' => 'Ubah Jadwal',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'jadwal' => $this->jadwal->find($id),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        ];

       return view('backend/jadwal/edit', $data); 
    }

    public function update($id = null){

        $rules = [
            'hari_buka' => [
                'label' => 'Hari Buka',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.', 
                ]
            ],
            'jam_buka' => [
                'label' => 'Jam Buka',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'jam_tutup' => [
                'label' => 'Jam Tutup',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->jadwal->update($id, $data); // simpan ke database

    return redirect()->to(base_url('masterdata/jadwal'))->with('message', 'Berhasil mengubah jadwal');
    }

    public function delete($id = null){

        $this->jadwal->delete($id); 

        return redirect()->to(base_url('masterdata/jadwal'))->with('message', 'Berhasil menghapus jadwal');
    }
}