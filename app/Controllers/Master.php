<?php

namespace App\Controllers;

use App\Database\Migrations\UserRole;
use \App\Models\UsersModel; // Memanggil User Model Dari Class Model
use \App\Models\UserRoleModel;
use \App\Models\KategoriModel;
use \App\Models\SatuanModel;
use \App\Models\ProdukModel;
use \App\Models\KasKeluarModel;
use TCPDF;

class Master extends BaseController
{

    //Membuat Variabel Untuk Menampung UsersModel
    protected $usersModel;
    protected $userRole;
    protected $kategoriModel;
    protected $satuanModel;
    protected $produkModel;
    protected $kasKeluarModel;

    public function __construct()
    {
        //Masukkan Users Model Ke Dalam Variabel
        $this->usersModel = new UsersModel();
        $this->userRole = new UserRoleModel();
        $this->kategoriModel = new KategoriModel();
        $this->satuanModel = new SatuanModel();
        $this->produkModel = new ProdukModel();
        $this->kasKeluarModel = new KasKeluarModel();
    }



    public function produk()
    {
        //1.Cek Login
        if (!session()->has('logged_in')) {
            //Jika tidak ada user yang login maka tendang
            //Login Dulu Kau
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !'); //Buat FlashData
            return redirect()->to(base_url()); // Arahkan ke halaman login
        } else {
            //Kalau sudah ada usernya cek apakah user itu admin ?
            if (session()->get('role_id') != 1) {
                //Kalau role id nya bukan 1 alias bukan admin berarti dia kasir
                return redirect()->to(base_url('kasir')); // Arahkan ke halaman kasir
            }
        }
        //Membuat Halaman Utama Produk
        $data = [
            'title' => 'BakeryAPP || Produk',
            'validation' => \Config\Services::validation()
        ];

        //Arahkan Ke Views Produk
        return view('master/produk', $data);
    }
}
