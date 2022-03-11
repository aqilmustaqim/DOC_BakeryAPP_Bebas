<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KasKeluar extends Migration
{
    public function up()
    {
        //id,kategori

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'keterangan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'tanggal'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'nominal'       => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('kas_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('kas_keluar');
    }
}
