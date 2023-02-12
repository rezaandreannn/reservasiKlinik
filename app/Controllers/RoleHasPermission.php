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
            'title' => 'Manage Role Permission',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'roles' => $this->role->findAll()
        ];

        return view('rolehaspermission/index', $data);
    }

    public function show($id = null){
        $data = [
            'title' => 'Detail Role Permission',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'role' => $this->role->find($id),
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
            $message = 'add permission to role succesfully';
        }else{
            $this->role->removePermissionFromGroup(intval($permissionId), intval($roleId));
            $message = 'remove permission from role succesfully';
        }
        return json_encode($message);
    }
}