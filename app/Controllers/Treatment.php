<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\TreatmentModel;
use App\Controllers\BaseController;



class Treatment extends BaseController
{

    protected $treatment, $session, $kategori;

    public function __construct(){
        $this->treatment = new TreatmentModel();
        $this->kategori = new KategoriModel();
        $this->session = service('session');
    }

    public function index()
    {
        $data = [
            'title' => 'Treatment',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'treatments' => $this->treatment->getAllWithKategori()
        ];

        // dd($data['treatments']);

       return view('backend/treatment/index', $data); 
    }

    public function new(){

        $data = [
            'title' => 'Tambah treatment',
            'breadcrumbs' => [
                'Dashboard' => '',
                'treatment' =>base_url('masterdata/treatment') ,
            ],
            'kategori' => $this->kategori->findAll()
        ];

       return view('backend/treatment/create', $data); 
    }

    public function create(){

        $rules = [
            'nama_treatment' => [
                'label' => 'Nama Treatment',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'kategori_id' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'gambar' => [
                'label' => 'Gambar',
                'rules' => 'mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,4096]',
                'errors' => [
                    'mime_in'  => 'Jenis file harus (jpg,jpeg,png)',
                    'max_size' => 'Maksimal 4 Mb'
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'durasi' => [
                'label' => 'durasi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'harga' => [
                'label' => 'Harga',
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
    $harga = $data['harga'];
    $intHarga = (int) str_replace('.', '', $harga);
    $data['harga'] = $intHarga;
    

     // simpan gambar
     $upload = $this->request->getFile('gambar');
     if($upload->getError() == 4){
     }else{
         $upload->move(WRITEPATH . '../public/images/treatment');
         $data['gambar'] = $upload->getName();
 
     }

    
    $this->treatment->insert($data); // simpan ke database

    return redirect()->to(base_url('masterdata/treatment'))->with('message', 'Berhasil membuat treatment');
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Ubah treatment',
            'breadcrumbs' => [
                'Dashboard' => '',
                'treatment' =>base_url('masterdata/treatment') ,
            ],
            'treatment' => $this->treatment->find($id),
            'kategori' => $this->kategori->findAll()
        ];

       return view('backend/treatment/edit', $data); 
    }

    public function update($id = null){

        $rules = [
            'nama_treatment' => [
                'label' => 'Nama Treatment',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'kategori_id' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'gambar' => [
                'label' => 'Gambar',
                'rules' => 'mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,4096]',
                'errors' => [
                    'mime_in'  => 'Jenis file harus (jpg,jpeg,png)',
                    'max_size' => 'Maksimal 4 Mb'
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'durasi' => [
                'label' => 'durasi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'harga' => [
                'label' => 'Harga',
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
    $harga = $data['harga'];
    $intHarga = (int) str_replace('.', '', $harga);
    $data['harga'] = $intHarga;
    

     // simpan gambar
     $upload = $this->request->getFile('gambar');
     if($upload->getError() == 4){
     }else{
         $upload->move(WRITEPATH . '../public/images/treatment');
         $data['gambar'] = $upload->getName();
 
     }

    
    $this->treatment->update($id , $data); // simpan ke database

    return redirect()->to(base_url('masterdata/treatment'))->with('message', 'Berhasil mengubah treatment');
    }

    public function delete($id = null){

        $this->treatment->delete($id); 

        return redirect()->to(base_url('masterdata/treatment'))->with('message', 'Berhasil menghapus treatment');
    }
}