<?php

namespace App\Controllers;

use App\Models\BankModel;
use App\Controllers\BaseController;

class Bank extends BaseController
{

    protected $bank, $session;

    public function __construct(){
        $this->bank = new BankModel();
        $this->session = service('session');
    }

    public function index()
    {
        $data = [
            'title' => 'Bank',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'banks' => $this->bank->findAll()
        ];

       return view('backend/bank/index', $data); 
    }

    public function new(){

        $data = [
            'title' => 'Tambah bank',
            'breadcrumbs' => [
                'Dashboard' => '',
                'bank' =>base_url('masterdata/bank') ,
            ],
        ];

       return view('backend/bank/create', $data); 
    }

    public function create(){

        $rules = [
            'nama_bank' => [
                'label' => 'Nama bank',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'no_rekening' => [
                'label' => 'No Rekening',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'logo_bank' => [
                'label' => 'Logo Bank',
                'rules' => 'mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,4096]',
                'errors' => [
                    'mime_in'  => 'Jenis file harus (jpg,jpeg,png)',
                    'max_size' => 'Maksimal 4 Mb'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post
    $data['status'] = 'aktif'; 

     // simpan gambar
     $upload = $this->request->getFile('logo_bank');
     if($upload->getError() == 4){
     }else{
         $upload->move(WRITEPATH . '../public/bank/images/');
         $data['logo_bank'] = $upload->getName();
 
     }
    
    $this->bank->insert($data); // simpan ke database

    return redirect()->to(base_url('masterdata/bank'))->with('message', 'Berhasil membuat bank');
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Ubah bank',
            'breadcrumbs' => [
                'Dashboard' => '',
                'bank' =>base_url('masterdata/bank') ,
            ],
            'bank' => $this->bank->find($id)
        ];

       return view('backend/bank/edit', $data); 
    }

    public function update($id = null){

        $rules = [
            'nama_bank' => [
                'label' => 'Nama bank',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'no_rekening' => [
                'label' => 'No Rekening',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'logo_bank' => [
                'label' => 'Logo Bank',
                'rules' => 'mime_in[logo_bank,image/jpg,image/jpeg,image/png]|max_size[logo_bank,4096]',
                'errors' => [
                    'mime_in'  => 'Jenis file harus (jpg,jpeg,png)',
                    'max_size' => 'Maksimal 4 Mb'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post

     // simpan gambar
     $upload = $this->request->getFile('logo_bank');
     if($upload->getError() == 4){
     }else{
         $upload->move(WRITEPATH . '../public/bank/images/');
         $data['logo_bank'] = $upload->getName();
 
     }
    
    $this->bank->update($id, $data); // simpan ke database
    return redirect()->to(base_url('masterdata/bank'))->with('message', 'Berhasil mengubah bank');
    }

    public function delete($id = null){

        $this->bank->delete($id); 

        return redirect()->to(base_url('masterdata/bank'))->with('message', 'Berhasil menghapus bank');
    }

}