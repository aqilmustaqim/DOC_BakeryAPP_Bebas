<?php

namespace App\Controllers;

use App\Database\Migrations\UserRole;
use \App\Models\UsersModel; // Memanggil User Model Dari Class Model
use \App\Models\UserRoleModel;

class Users extends BaseController
{

    //Membuat Variabel Untuk Menampung UsersModel
    protected $usersModel;
    protected $userRole;

    public function __construct()
    {
        //Masukkan Users Model Ke Dalam Variabel
        $this->usersModel = new UsersModel();
        $this->userRole = new UserRoleModel();
    }

    public function index()
    {
        //cek status login
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        } else {
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url('kasir'));
            }
        }
        //Query JOIN TABEL USER DAN USER_ROLE
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as id_users, user_role.id as id_role, nama, username, email, is_active, role_id, created_at,role ');
        $builder->join('user_role', 'users.role_id = user_role.id');
        $query = $builder->get();
        $users = $query->getResultArray();


        //QUERY USER_ROLE
        $role = $this->userRole->findAll();

        $data = [
            'title' => 'PosCafe || Data User',
            'users' => $users,
            'role' => $role,
            'validation' => \Config\Services::validation()
        ];

        return view('users/index', $data);
    }

    public function tambahUser()
    {
        //Masukkan Users Ke Database
        if ($this->usersModel->save([
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'foto' => 'default.png',
            'is_active' => 1,
            'role_id' => $this->request->getVar('role')
        ])) {
            //Kasih Flash Message
            session()->setFlashdata('users', 'Ditambahkan');
            return redirect()->to(base_url('users'));
        }
    }
}
