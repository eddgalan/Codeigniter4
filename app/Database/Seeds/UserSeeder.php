<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $dataUser = [
            [
                'id' => 1,
                'name' => 'Admin',
                'lastname' => '-',
                'username' => 'admin',
                'email' => 'admin@correo.com',
                'password' => '$2y$10$lXVl.TkeevYzUWnOL/QZxO3HAkiGYk9O3ZByd6QC/U4EpDhg0jP5.',   // 12345678a
            ],
            [
                'id' => 2,
                'name' => 'User',
                'lastname' => '-',
                'username' => 'user',
                'email' => 'user@correo.com',
                'password' => '$2y$10$lXVl.TkeevYzUWnOL/QZxO3HAkiGYk9O3ZByd6QC/U4EpDhg0jP5.',   // 12345678a
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        // $this->db->table('users')->insert($dataUser);
        $this->db->table('users')->insertBatch($dataUser);

        $dataProfile = [
            [
                'user_id' => 1,
                'role' => 1,
                'admission_date' => date('Y-m-d'),
                'city' => 'CDMX',
                'telephone_number' => '0000000000',
                'path_img' => '',
            ],
            [
                'user_id' => 2,
                'role' => 2,
                'admission_date' => date('Y-m-d'),
                'city' => 'CDMX',
                'telephone_number' => '0000000000',
                'path_img' => '',
            ],
        ];
        $this->db->table('profiles')->insertBatch($dataProfile);
    }
}
