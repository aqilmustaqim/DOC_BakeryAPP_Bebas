<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $allowedFields = ['kode_produk', 'nama_produk', 'satuan_produk', 'kategori_produk', 'stok_produk', 'modal_produk', 'harga_produk', 'keterangan_produk', 'foto_produk'];
}
