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

        $data = [
            'title' => 'Admin || BakeryAPP',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/index', $data);
    }
}
