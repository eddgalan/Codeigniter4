<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 5,
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => 50,
                'null'          => false,
            ],
            'lastname' => [
                'type'          => 'VARCHAR',
                'constraint'    => 50,
                'null'          => false,
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => 50,
                'null'          => false,
                'unique'        => true,
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'null'          => false,
                'unique'        => true,
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => false,
            ],
            'created_at' => [
                'type'      => 'TIMESTAMP',
                'default'   => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'      => 'TIMESTAMP',
                'default'   => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users', true, false);
    }
}
