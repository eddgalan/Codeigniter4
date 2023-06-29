<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 1,
            'name' => 'Admin',
            'lastname' => '-',
            'username' => 'admin',
            'email' => 'admin@correo.com',
            'password' => '$2y$10$lXVl.TkeevYzUWnOL/QZxO3HAkiGYk9O3ZByd6QC/U4EpDhg0jP5.',   // 12345678a
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
