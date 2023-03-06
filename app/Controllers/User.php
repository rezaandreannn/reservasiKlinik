<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $db, $builder, $group, $user;

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->group   = new GroupModel();
        $this->user   = new UserModel();
    }

    public function index()
    {
      
        $data = [
            'title' => 'Daftar Pengguna',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'users' => $this->user->withDeleted()->findAll(),
        ];


        return view('user/index', $data);
    }

    public function show($id = null){

        $user = $this->user->find($id);
        if($user){

            $data = [
                'user' => $user,
                'userGroup' => $this->group->getGroupsForUser($id),
                'grups' => $this->group->findAll()
            ];
            
            return view('user/show', $data);

        }else{
             return redirect()->back()->with('message', 'Pengguna tidak ditemukan');
        }
    }

    public function edit($id = null){
       
        return view('user/edit');
    }

    public function manageRole(){

        $userId = $this->request->getPost('userId');
        $roleId = $this->request->getPost('roleId');
        $action = $this->request->getPost('action');

        // Use a single group id
        if($action == 'insert'){
            $this->group->addUserToGroup(intval($userId), intval($roleId));
            $message = 'Berhasil menambahkan grup';
        }else{
            $this->group->removeUserFromGroup(intval($userId), intval($roleId));
            $message = 'Berhasil menghapus grup';
        }
        return json_encode($message);

    }

    public function delete($id = null){

            $this->user->delete($id);
            return redirect()->to(base_url('admin/pengguna'))->with('message', 'Berhasil menghapus pengguna sementara');
    }

    public function forceDelete($id = null){
        $this->user->delete($id, true);
        return redirect()->to(base_url('admin/pengguna'))->with('message', 'Data berhasil dihapus secara permanen');
    }

 

    public function restore($id = null)
    {
       if ($this->user->withDeleted()->find($id)) {
           $this->user->update($id, ['deleted_at' => null]);
           return redirect()->to('admin/pengguna')->with('message', 'Pengguna berhasil dikembalikan');
         
       }else{
        return redirect()->to('admin/pengguna')->with('error', 'Pengguna Tidak ditemukan');
       }
       
    }
}