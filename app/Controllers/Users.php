<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        if (! session()->get('userLogged')) {
            return redirect()->to(base_url('admin/login'));
        }
        $data = [
            'title' => 'Admin | Users',
            'view' => 'admin/users/index',
        ];
        return view('newTemplates/index', $data);
    }
}
