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

    public function loginSave()
    {
        //Validasi Form Terlebih Dahulu
        if (!$this->validate([
            //Field Yang mau divalidasi
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ]
        ])) {
            //Kalau tidak tervalidasi
            return redirect()->to(base_url())->withInput();
        }

        //Kalau Lolos
        //1. Ambil Inputan Username Dan Password
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        //2. Cocokkan Dengan Yang Ada DiDatabase
        $user = $this->usersModel->where(['username' => $username])->first();
        if ($user) {
            //Kalau ada user nya cek passwordnya sama atau tidak dengan inputan 
            if (password_verify($password, $user['password'])) {
                //Kalau Password Nya sama maka cek apakah usernya aktif ?
                if ($user['is_active'] == 1) {
                    //Kalau usernya aktif maka login berhasil
                    //1.Simpan session usernya
                    $dataSession = [
                        'nama' => $user['nama'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                        'logged_in' => TRUE
                    ];
                    session()->set($dataSession);
                    //2. Redirect Kehalaman Role id masing masing
                    if ($user['role_id'] == 1) {
                        return redirect()->to(base_url('admin'));
                    } else if ($user['role_id'] == 2) {
                        return redirect()->to(base_url('kasir'));
                    }
                } else {
                    //Kalau usernya gak aktif
                    session()->setFlashdata('login', 'Akun anda dinonaktifkan, harap hubungi admin ! ');
                    return redirect()->to(base_url());
                }
            } else {
                //Kalau Passwordnya gak sama , kasih pesan error
                session()->setFlashdata('login', 'Password yang anda masukkan salah ! ');
                return redirect()->to(base_url());
            }
        } else {
            //Kalau user nya gak ada
            session()->setFlashdata('login', 'Username Belum Terdaftar ! ');
            return redirect()->to(base_url());
        }
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
