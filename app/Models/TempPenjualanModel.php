<?php

namespace App\Models;

use CodeIgniter\Model;

class TempPenjualanModel extends Model
{
    protected $table      = 'temp_penjualan';
    protected $allowedFields = ['invoice', 'kode_produk', 'harga_beli', 'harga_jual', 'jumlah', 'subtotal'];
}
