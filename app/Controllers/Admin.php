<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin || BakeryAPP',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/index');
    }
}
