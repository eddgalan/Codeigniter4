<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    public function login()
    {
        helper('form');
        if (! $this->request->is('post')) {
            if (session()->get('userLogged')) {
                return redirect()->to(base_url('/admin/index'));
            }
            return view('login');
        }
        $user = $this->request->getPost('user');
        $password = $this->request->getPost('password');

        $dataToValidate = array('user' => $user, 'password' => $password);
        $validationRules = array(
            'user' => 'required|max_length[50]|min_length[3]',
            'password'  => 'required|max_length[255]|min_length[8]',
        );

        if (! $this->validateData($dataToValidate, $validationRules)) {
            return view('login');
        }

        $userModel = model(UsersModel::class);
        $userData = $userModel->getValidUser($user, $password);
        if (! $userData) {
            return redirect()->to(base_url('/admin/login'))->with('error', 'User or password not valid');
        }
        $userModel->setUserSession($userData);
        return redirect()->to(base_url('/admin/index'));
    }

    public function index()
    {
        if (! session()->get('userLogged')) {
            return redirect()->to(base_url('admin/login'));
        }
        return view('index', ['userLogged' => session()->get('userLogged')]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }

}
