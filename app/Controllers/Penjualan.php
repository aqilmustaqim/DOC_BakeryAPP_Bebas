<?php

namespace App\Controllers;

use App\Database\Migrations\Produk;
use App\Database\Migrations\UserRole;
use \App\Models\UsersModel; // Memanggil User Model Dari Class Model
use \App\Models\UserRoleModel;
use \App\Models\TempPenjualanModel;
use \App\Models\ProdukModel;
use \App\Models\PenjualanModel;
use \App\Models\PenjualanDetailModel;
use PhpParser\Node\Expr\Cast\Array_;
use TCPDF;

class Penjualan extends BaseController
{
    protected $usersModel; //Membuat Variabel Untuk Menampung UsersModel
    protected $userRole;
    protected $tempPenjualanModel;
    protected $produkModel;
    protected $penjualanModel;
    protected $penjualanDetailModel;

    public function __construct()
    {
        //Masukkan Users Model Ke Dalam Variabel
        $this->usersModel = new UsersModel();
        $this->userRole = new UserRoleModel();
        $this->tempPenjualanModel = new TempPenjualanModel();
        $this->produkModel = new ProdukModel();
        $this->penjualanModel = new PenjualanModel();
        $this->penjualanDetailModel = new PenjualanDetailModel();
    }

    public function inputPenjualan()
    {
        //cek status login
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'BakeryAPP || Data User',
            'validation' => \Config\Services::validation(),
            'invoice' => $this->buatInvoice()
        ];

        return view('penjualan/inputPenjualan', $data);
    }

    public function buatInvoice()
    {
        //Fungsi Membuat Invoice Penjualan
        $tanggal = date('Y-m-d'); //Ambil Tanggal Hari ini
        $db      = \Config\Database::connect(); //Connect Database 
        $builder = $db->table('penjualan'); //Inisialisasi Tabel
        $builder->selectMax('invoice'); //Untuk Menampilkan Data Numerik Tertinggi dari invoice
        $builder->where('tanggal', $tanggal); //Yg dimana tanggal == tanggal hariini
        $query = $builder->get();
        $hasil = $query->getRowArray();
        $users = $hasil['invoice'];
        $lastNoUrut = substr($users, -4);
        $next = intval($lastNoUrut) + 1;
        $noinvoice = "TRX" . date('dmy', strtotime($tanggal)) . sprintf('%05s', $next);
        return $noinvoice;
    }
}
