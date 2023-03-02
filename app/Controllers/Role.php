<?php

namespace App\Controllers;

use Myth\Auth\Models\GroupModel;
use App\Controllers\BaseController;

class Role extends BaseController
{
    protected $role, $session;

    public function __construct(){
        $this->role = new GroupModel();
        $this->session = service('session');
    }

    public function index()
    {

        $data = [
            'title' => 'Kelola Grup',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'roles' => $this->role->findAll()
        ];

        return view('role/index', $data);
    }

    public function new(){
      
        $data = [
            'title' => 'Tambah Grup',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Role' => ''
            ],
           
           
        ];

        return view('role/create', $data);
    }

    public function create(){
        $rules = [
            'name' => [
                'label' => 'Nama Grup',
                'rules' => 'required|is_unique[auth_groups.name]',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                    'is_unique' => '{field} Sudah Ada.' 
                ]
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.', 
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->role->insert($data); // simpan ke database

    return redirect()->to(base_url('admin/grup'))->with('message', 'created role successfully');
    }

    public function edit($id = null){
        session();
        $data = [
            'title' => 'Ubah Grup',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Role' => ''
            ],
            'role' => $this->role->find($id),
            'validation' => \Config\Services::validation() // untuk mencetak validasi di view
           
        ];

        return view('role/edit', $data);
    }

    public function update($id = null){
        $rules = [
            'name' => [
                'label' => 'Nama Grup',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                    'is_unique' => '{field} Sudah Ada.' 
                ]
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.', 
                ]
            ],
        ];

        $group = $this->role->find($id);

        if ($group) {
            $nameRule = $rules['name'];
            $nameRule['rules'] .= '|is_unique[auth_groups.name,id,' . $group->id . ']';
    
            if ($this->request->getPost('name') === $group->name) {
                // Jika nilai name tidak berubah, maka hapus aturan validasi is_unique
                $nameRule['rules'] = str_replace('|is_unique[auth_groups.name,id,' . $group->id . ']', '', $nameRule['rules']);
            }
    
            $rules['name'] = $nameRule;
        }


        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->role->update($id, $data); // simpan ke database

    return redirect()->to(base_url('admin/grup'))->with('message', 'updated role successfully');
    }

    public function delete($id = null){

        $this->role->delete($id);
        return redirect()->to(base_url('admin/grup'))->with('message', 'deleteted role successfully');


    }
}