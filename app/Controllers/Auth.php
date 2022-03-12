<?php

namespace App\Controllers;

class Auth extends BaseController
{
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
}
