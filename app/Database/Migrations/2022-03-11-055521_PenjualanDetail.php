<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenjualanDetail extends Migration
{
    public function up()
    {
        //id, invoice, kode_produk, harga_beli , harga_jual , jumlah, subtotal

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'invoice'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'kode_produk' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'harga_beli' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'harga_jual' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'jumlah' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'subtotal' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('penjualan_detail');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan_detail');
    }
}
