<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'lastname', 'username', 'email', 'password'];
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    public function getUserByUsername($username)
    {
        return $this->where(['username' => $username])->first();
    }

    public function getValidUser($username, $password)
    {
        $userData = $this->getUserByUsername($username);
        if (! $userData) {
            return false;
        }

        if (! password_verify($password, $userData['password'])) {
            return false;
        }

        return $userData;
    }

    public function setUserSession($userData)
    {
        $userData_ = array(
            "id" => $userData['id'],
            "name" => $userData['name'],
            "lastname" => $userData['lastname'],
            "email" => $userData['email'],
        );
        session()->set(["userLogged" => $userData_]);
    }

}
