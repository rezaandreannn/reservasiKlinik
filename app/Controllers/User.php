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
        //get query users
        $this->builder->select('users.id as userId, email, username, GROUP_CONCAT(auth_groups.name SEPARATOR ", ") as name ');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.deleted_at', NULL);
        $this->builder->groupBy('auth_groups_users.user_id');
        $query = $this->builder->get();

        $data = [
            'title' => 'User List',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'users' => $query->getResult(),
            'groups'=> $this->group->findAll(),
            'sumGroup' => $this->group->countAll()
        ];

        // dd($data['users']);

        return view('user/index', $data);
    }

    public function manageRole(){

        $userId = $this->request->getPost('userId');
        $roleId = $this->request->getPost('roleId');
        $action = $this->request->getPost('action');

        // Use a single group id
        if($action == 'insert'){
            $this->group->addUserToGroup(intval($userId), intval($roleId));
            $message = 'add role from user succesfully';
        }else{
            $this->group->removeUserFromGroup(intval($userId), intval($roleId));
            $message = 'remove role from user succesfully';
        }
        return json_encode($message);

    }

    public function delete($id = null){

            $this->user->delete($id);
            return redirect()->to(base_url('user'))->with('message', 'deleteted user successfully');
    }
}