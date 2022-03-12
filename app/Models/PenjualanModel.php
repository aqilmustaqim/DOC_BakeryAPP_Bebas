<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table      = 'penjualan';
    protected $allowedFields = ['invoice', 'tanggal', 'pelanggan', 'kasir', 'jumlah_uang', 'sisa_uang', 'total'];
}
