<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use App\Controllers\BaseController;

class Profile extends BaseController
{
    protected  $user, $group;

    public function __construct(){
        $this->user   = new UserModel();
        $this->group   = new GroupModel();
    }
    public function index()
    {
        $id = user()->id;
        $user = $this->user->find($id);
        if($user){
            $data = [
                'user' => $user,
                'userGroup' => $this->group->getGroupsForUser($id),
                'grups' => $this->group->findAll()
            ];
            
            return view('profile', $data);
        }
    }
}