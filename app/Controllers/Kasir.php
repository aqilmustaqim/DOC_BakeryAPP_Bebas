<?php

namespace App\Controllers;

class Kasir extends BaseController
{

    public function __construct()
    {
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        }
    }

    public function index()
    {

        //Menghitung Jumlah Penjualan
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->selectCount('id');
        $query = $builder->get();
        $jumlahPenjualan = $query->getRowArray();
        $penjualan = $jumlahPenjualan['id'];


        $data = [
            'title' => 'BakeryAPP || Kasir',
            'penjualan' => $penjualan
        ];

        return view('kasir/index', $data);
    }
}
