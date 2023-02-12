<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\PermissionModel;

class Permission extends BaseController
{

    protected $permission;

    public function __construct(){
        $this->permission = new PermissionModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Manage Permission',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'permissions' => $this->permission->findAll()
        ];

        return view('permission/index', $data);
    }

    public function new(){
        session();
        $data = [
            'title' => 'Create Permission',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Permission' => ''
            ],
            'validation' => \Config\Services::validation() // untuk mencetak validasi di view
           
        ];

        return view('permission/create', $data);
    }

    public function create(){
        $validate =  $this->validate([
            'name' => [
                'rules'  => 'required',
               
            ],    
            'description' => [
                'rules'  => 'required',
                
            ],    
        ]); // rules validasi simpan


    if (!$validate) { //jika validasi gagal
        return redirect()->back()->withInput();        
    }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->permission->insert($data); // simpan ke database

    return redirect()->to(base_url('admin/permission'))->with('message', 'created permission successfully');
    }

    public function edit($id = null){

        session();
        $data = [
            'title' => 'Edit Permission',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Permission' => ''
            ],
            'permission' => $this->permission->find($id),
            'validation' => \Config\Services::validation() // untuk mencetak validasi di view
           
        ];

        return view('permission/edit', $data);
    }

    public function update($id = null){
        $validate =  $this->validate([
            'name' => [
                'rules'  => 'required',
               
            ],    
            'description' => [
                'rules'  => 'required',
                
            ],    
        ]); // rules validasi simpan


    if (!$validate) { //jika validasi gagal
        return redirect()->back()->withInput();        
    }
    

    $data = $this->request->getPost(); //ambil inputan post
    $this->permission->update($id, $data); // simpan ke database

    return redirect()->to(base_url('admin/permission'))->with('message', 'updated permission successfully');
    }

    public function delete($id = null){

        $this->permission->delete($id);
        return redirect()->to(base_url('admin/permission'))->with('message', 'deleteted permission successfully');


    }

}