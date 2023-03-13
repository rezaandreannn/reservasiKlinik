<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Controllers\BaseController;

class Kategori extends BaseController
{
    protected $kategori, $session;

    public function __construct(){
        $this->kategori = new KategoriModel();
        $this->session = service('session');
    }


    public function index()
    {

        $data = [
            'title' => 'Kategori',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'kategories' => $this->kategori->findAll()
        ];

       return view('backend/kategori/index', $data); 
    }

    public function new(){

        $data = [
            'title' => 'Tambah Kategori',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
           
        ];

       return view('backend/kategori/create', $data); 
    }

    public function create(){

        $rules = [
            'nama_kategori' => [
                'label' => 'Nama Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'deskripsi' => [
                'label' => 'deskripsi',
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
    $this->kategori->insert($data); // simpan ke database

    return redirect()->to(base_url('masterdata/kategori'))->with('message', 'Berhasil membuat kategori');
    }

    public function edit($id = null){

        $data = [
            'title' => 'Ubah Kategori',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'kategori' => $this->kategori->find($id),
        ];

       return view('backend/kategori/edit', $data); 
    }

    public function update($id = null){

       
        $rules = [
            'nama_kategori' => [
                'label' => 'Nama Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'deskripsi' => [
                'label' => 'deskripsi',
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
    $this->kategori->update($id, $data); // simpan ke database

    return redirect()->to(base_url('masterdata/kategori'))->with('message', 'Berhasil mengubah kategori');
    }

    public function delete($id = null){

        $this->kategori->delete($id); 

        return redirect()->to(base_url('masterdata/kategori'))->with('message', 'Berhasil menghapus kategori');
    }
}