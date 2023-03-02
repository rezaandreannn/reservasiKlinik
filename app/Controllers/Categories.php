<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Controllers\BaseController;

class Categories extends BaseController
{
 
    protected $categories;

    public function __construct(){
        $this->categories = new CategoriesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manage Categories',
            'breadcrumbs' => [
                'Dashboard' => '',
            ],
            'categories' => $this->categories->findAll()
        ];
        return view('categories/index', $data);
    }
}