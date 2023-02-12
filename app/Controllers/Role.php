<?php

namespace App\Controllers;

use Myth\Auth\Models\GroupModel;
use App\Controllers\BaseController;

class Role extends BaseController
{
    protected $role;

    public function __construct(){
        $this->role = new GroupModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Manage Role',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'roles' => $this->role->findAll()
        ];

        return view('role/index', $data);
    }

    public function new(){
        session();
        $data = [
            'title' => 'Create Role',
            'breadcrumbs' => [
                'Dashboard' => '',
                'Role' => ''
            ],
            'validation' => \Config\Services::validation() // untuk mencetak validasi di view
           
        ];

        return view('role/create', $data);
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
    $this->role->insert($data); // simpan ke database

    return redirect()->to(base_url('role'))->with('message', 'created role successfully');
    }

    public function edit($id = null){
        session();
        $data = [
            'title' => 'Edit Role',
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
    $this->role->update($id, $data); // simpan ke database

    return redirect()->to(base_url('role'))->with('message', 'updated role successfully');
    }

    public function delete($id = null){

        $this->role->delete($id);
        return redirect()->to(base_url('role'))->with('message', 'deleteted role successfully');


    }
}