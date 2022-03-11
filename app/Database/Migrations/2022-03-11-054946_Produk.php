<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        //id, kode Produk, Nama Produk, Satuan , Kategori , Modal, Harga Jual, Stok, Keterangan, Foto

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'kode_produk'       => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'nama_produk'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'satuan_produk' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'kategori_produk' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'stok_produk' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'modal_produk' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'harga_produk' => [
                'type'           => 'INT',
                'constraint'     => '128'
            ],
            'foto_produk' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'keterangan_produk' => [
                'type'           => 'TEXT',
                'constraint'     => '500'
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
