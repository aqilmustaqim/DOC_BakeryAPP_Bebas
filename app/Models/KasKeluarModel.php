<?php

namespace App\Models;

use CodeIgniter\Model;

class KasKeluarModel extends Model
{
    protected $table      = 'kas_keluar';
    protected $allowedFields = ['keterangan', 'tanggal', 'nominal'];
}
