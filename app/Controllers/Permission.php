<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\PermissionModel;

class Permission extends BaseController
{

    protected $permission, $session;

    public function __construct(){
        $this->session = service('session');
        $this->permission = new PermissionModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Kelola Perizinan',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'permissions' => $this->permission->findAll()
        ];

        return view('permission/index', $data);
    }

    public function new(){
      
        $data = [
            'title' => 'Tambah Perizinan',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Perizinan' =>  base_url('admin/perizinan')
            ],
        ];

        return view('permission/create', $data);
    }

    public function create(){
        $rules = [
            'name' => [
                'label' => 'Nama Perizinan',
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
    $this->permission->insert($data); // simpan ke database

    return redirect()->to(base_url('admin/perizinan'))->with('message', 'created permission successfully');
    }

    public function edit($id = null){

        $data = [
            'title' => 'Ubah Perizinan',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Perizinan' =>  base_url('admin/perizinan')
            ],
            'permission' => $this->permission->find($id),
        ];

        return view('permission/edit', $data);
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

        $permission = $this->permission->find($id);

        if ($permission) {
            $nameRule = $rules['name'];
            $nameRule['rules'] .= '|is_unique[auth_permissions.name,id,' . $permission->id . ']';
    
            if ($this->request->getPost('name') === $permission->name) {
                // Jika nilai name tidak berubah, maka hapus aturan validasi is_unique
                $nameRule['rules'] = str_replace('|is_unique[auth_permissions.name,id,' . $permission->id . ']', '', $nameRule['rules']);
            }
    
            $rules['name'] = $nameRule;
        }


        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->permission->update($id, $data); // simpan ke database

    return redirect()->to(base_url('admin/perizinan'))->with('message', 'updated permission successfully');
    }

    public function delete($id = null){

        $this->permission->delete($id);
        return redirect()->to(base_url('admin/perizinan'))->with('message', 'deleteted permission successfully');


    }

}