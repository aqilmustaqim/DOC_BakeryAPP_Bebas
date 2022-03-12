<?php

namespace App\Controllers;

use \App\Models\UsersModel; // Memanggil User Model Dari Class Model

class Auth extends BaseController
{

    //Membuat Variabel Untuk Menampung UsersModel
    protected $usersModel;

    public function __construct()
    {
        //Mengisi variabel dengan models
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        //Membuat Array Data Untuk Dikirim keparameter view
        $data = [
            'title' => 'BakeryAPP || Login',
            'validation' => \Config\Services::validation()
        ];
        //Mengarahkan ke view folder auth file login dengan paramter $data
        return view('auth/login', $data);
    }

    public function registerSave()
    {
        //Memasukkan Data Ke Dalam Database Tabel Users
        //Ini data untuk pertama aja biar ada data users yang dihash untuk buat loginnya
        //Nanti bakal diganti valuenya dengan form yang ada diadmin
        $password = 'admin';
        if ($this->usersModel->save([
            'nama' => 'Aqil Mustaqim',
            'username' => 'admin',
            'email' => 'aqilmustaqim28@gmail.com',
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'foto' => 'default.png',
            'role_id' => 1,
            'is_active' => 1
        ])) {
            echo 'berhasil ygy';
        }
    }
}
