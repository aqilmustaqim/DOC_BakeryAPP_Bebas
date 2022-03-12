<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin || BakeryAPP',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/index', $data);
    }
}
