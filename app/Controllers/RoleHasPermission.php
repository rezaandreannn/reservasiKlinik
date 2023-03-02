<?php

namespace App\Controllers;

use Myth\Auth\Models\GroupModel;
use App\Controllers\BaseController;
use Myth\Auth\Models\PermissionModel;

class RoleHasPermission extends BaseController
{
    protected $role, $permission;

    public function __construct(){
        $this->role = new GroupModel();
        $this->permission = new PermissionModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Kelola Perizinan Grup',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'roles' => $this->role->findAll()
        ];

        return view('rolehaspermission/index', $data);
    }

    public function show($id = null){

        $role = $this->role->find($id);

        $data = [
            'title' => 'Detail Perizinan Grup ' . ': ' . ucfirst($role->name),
            'breadcrumbs' => [
                'Dashboard' => '',
                'Perizinan Grup' => base_url('admin/perizinan-grup')
            ],
            'role' => $role,
            'permissions' => $this->permission->findAll()
        ];

        return view('rolehaspermission/show', $data);
    }

    public function changePermission(){
        $roleId = $this->request->getPost('roleId');
        $permissionId = $this->request->getPost('permissionId');
        $action = $this->request->getPost('action');

        // Use a single group id
        if($action == 'insert'){
            $this->role->addPermissionToGroup(intval($permissionId), intval($roleId));
            $message = 'Menambahkan perizinan baru';
        }else{
            $this->role->removePermissionFromGroup(intval($permissionId), intval($roleId));
            $message = 'Menghapus perizinan';
        }
        return json_encode($message);
    }
}