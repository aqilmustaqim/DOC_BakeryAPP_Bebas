<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
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

        //Menghitung Jumlah User
        //1.Menggunakan Builder Database
        $db = \Config\Database::connect(); //Connect Database
        $builder = $db->table('users'); //Inisialisasi Tabel
        $builder->selectCount('id'); //Menghitung Jumlah Tabel Id
        $hasil = $builder->get(); //Tampung Hasil Di Variabel
        $jumlahUsers = $hasil->getRowArray(); //Ambil Berupa array
        $users = $jumlahUsers['id'];

        //Mengitung Jumlah Admin
        $db = \Config\Database::connect();
        $builder = $db->table('users'); //Inisialisasi Tabel
        $builder->selectCount('role_id'); // Menghitung Tabel id
        $builder->where('role_id', 1);
        $hasil = $builder->get(); // Tampung Di variabel
        $jumlahAdmin = $hasil->getRowArray();
        $admin = $jumlahAdmin['role_id'];

        //Menghitung Jumlah Kasir
        $db = \Config\Database::connect(); //Connect ke database
        $builder = $db->table('users'); // Menginsialisasikan Tabel
        $builder->selectCount('role_id'); //Menghitung ID
        $builder->where('role_id', 2); // Yang mana yg role id nya kasir alias 2
        $hasil = $builder->get(); // Mendapatkan hasil
        $jumlahKasir = $hasil->getRowArray(); // Memecah ke dalam row array
        $kasir = $jumlahKasir['role_id'];

        //Total Produk
        $db = \Config\Database::connect(); //Connect ke database
        $builder = $db->table('produk');
        $builder->selectCount('id');
        $hasil = $builder->get();
        $jumlahProduk = $hasil->getRowArray();
        $produk = $jumlahProduk['id'];

        //Total Kategori
        $db = \Config\Database::connect();
        $builder = $db->table('kategori');
        $builder->selectCount('id');
        $hasil = $builder->get();
        $totalKategori = $hasil->getRowArray();
        $kategori = $totalKategori['id'];

        //Menghitung Jumlah Penjualan
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->selectCount('id');
        $query = $builder->get();
        $jumlahPenjualan = $query->getRowArray();
        $penjualan = $jumlahPenjualan['id'];

        //Menghitung Total Penjualan Hari Ini
        //Jalankan Query SUM untuk jumlah total penjualan
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->select('SUM(total) as totalpenjualan');
        $builder->where('tanggal', date('Y-m-d'));
        $query = $builder->get();
        $hasilpenjualan = $query->getRowArray();
        if ($hasilpenjualan) {
            $penjualanhariini = $hasilpenjualan['totalpenjualan'];
        } else {
            $penjualanhariini = 0;
        }

        //Menghitung Total Penjualan Bulan Ini
        //Jalankan Query SUM untuk jumlah total penjualan
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->select('SUM(total) as totalpenjualan');
        $builder->like('tanggal', date('m'));
        $query = $builder->get();
        $hasilpenjualan = $query->getRowArray();
        if ($hasilpenjualan) {
            $penjualanBulanIni = $hasilpenjualan['totalpenjualan'];
        } else {
            $penjualanBulanIni = 0;
        }

        //Menghitung Total Penjualan Tahun Ini
        //Jalankan Query SUM untuk jumlah total penjualan
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->select('SUM(total) as totalpenjualan');
        $builder->like('tanggal', date('Y'));
        $query = $builder->get();
        $hasilpenjualan = $query->getRowArray();
        if ($hasilpenjualan) {
            $penjualanTahunIni = $hasilpenjualan['totalpenjualan'];
        } else {
            $penjualanTahunIni = 0;
        }


        //Mengambil Data Penjualan Hari Ini
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->select('*');
        $builder->where('tanggal', date('Y-m-d'));
        $query = $builder->get();
        $dataPenjualan = $query->getResultArray();

        //Menghitung Jumlah Produk Paling Banyak Terjual
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan_detail');
        $builder->select('penjualan_detail.kode_produk,foto_produk,harga_produk,nama_produk,SUM(jumlah) as jumlah_terjual');
        $builder->selectCount('penjualan_detail.kode_produk');
        $builder->join('produk', 'penjualan_detail.kode_produk = produk.kode_produk');
        $builder->orderBy('jumlah_terjual', 'DESC');
        $builder->groupBy('penjualan_detail.kode_produk');
        $builder->limit(5);
        $query = $builder->get();
        $produkterbanyak = $query->getResultArray();

        $data = [
            'title' => 'Admin || BakeryAPP',
            'validation' => \Config\Services::validation(),
            'users' => $users,
            'admin' => $admin,
            'kasir' => $kasir,
            'produk' => $produk,
            'kategori' => $kategori,
            'penjualan' => $penjualan,
            'totalpenjualan' => $penjualanhariini,
            'totalpenjualanbulanan' => $penjualanBulanIni,
            'totalpenjualantahunan' => $penjualanTahunIni,
            'datapenjualan' => $dataPenjualan,
            'produkterbanyak' => $produkterbanyak

        ];
        //View Index Admin
        return view('admin/index', $data);
    }
}
