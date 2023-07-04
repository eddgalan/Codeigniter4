<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var string[]
     */
    protected $allowedFields = ['name', 'lastname', 'username', 'email', 'password'];
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @param $username
     * @return array|object|null
     */
    public function getUserByUsername($username)
    {
        return $this->where(['username' => $username])->first();
    }

    /**
     * @param $username
     * @param $password
     * @return array|false|object
     */
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

    /**
     * @param $userData
     * @return void
     */
    public function setUserSession($userData)
    {
        $userData_ = array(
            "id" => $userData['id'],
            "name" => $userData['name'],
            "lastname" => $userData['lastname'],
            "username" => $userData['username'],
            "email" => $userData['email'],
        );
        session()->set(["userLogged" => $userData_]);
    }

}
