<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'user_id' => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'unique'            => true,
            ],
            'role' => [
                'type'              => 'TINYINT',
                'unsigned'          => true,
                /** 1 = Admin, 2 = Limited User */
            ],
            'admission_date' => [
                'type'              => 'DATE',
                'null'              => true,
            ],
            'city' => [
                'type'              => 'VARCHAR',
                'constraint'        => 150,
                'null'              => true,
            ],
            'telephone_number'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 15,
                'null'              => false,
            ],
            'path_img' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            '',
            'CASCADE',
            'userFK'
        );
        $this->forge->createTable('profiles');
    }

    public function down()
    {
        $this->forge->dropTable('profiles', true, false);
    }
}
