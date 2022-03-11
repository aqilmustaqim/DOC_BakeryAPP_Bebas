<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        //id,nama,username,email,password,foto,is_active,role,created_at,updated_at

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'hint' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'foto' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'role_id' => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'is_active' => [
                'type'           => 'INT',
                'constraint'     => '1'
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'             => TRUE
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'             => TRUE
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
