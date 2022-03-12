<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanDetailModel extends Model
{
    protected $table      = 'temp_penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = ['invoice', 'kode_produk', 'harga_beli', 'harga_jual', 'jumlah', 'subtotal'];
}
