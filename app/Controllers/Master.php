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

    public function kategori()
    {
        //Cek Login
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        } else {
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url('kasir'));
            }
        }

        //Mengambil Semua Data Kategori
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'BakeryAPP || Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori
        ];

        return view('master/kategori', $data);
    }

    public function tambahKategori()
    {
        //Tangkap Data
        $kategori = $this->request->getVar('kategori');

        //Masukkan Ke Database 
        if ($this->kategoriModel->save([
            'kategori' => $kategori
        ])) {
            echo '1';
        }
    }

    public function hapusKategori($id)
    {
        //Hapus
        if ($this->kategoriModel->delete($id)) {
            return redirect()->to(base_url('master/kategori'));
        }
    }

    public function satuan()
    {
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        } else {
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url('kasir'));
            }
        }

        $satuan = $this->satuanModel->findAll();

        $data = [
            'title' => 'BakeryAPP || Kategori',
            'validation' => \Config\Services::validation(),
            'satuan' => $satuan
        ];

        return view('master/satuan', $data);
    }

    public function tambahSatuan()
    {
        //Ambil Data Yang Dikirim Ajax
        $satuan = $this->request->getVar('satuan');

        //Masukkan Ke Dalam Database
        if ($this->satuanModel->save([
            'satuan' => $satuan
        ])) {
            echo '1';
        }
    }

    public function ubahSatuan()
    {
        //Ambil Data Yang Dikirim Ajax
        $id = $this->request->getVar('id');
        $satuan = $this->request->getVar('satuan');

        //Ubah Database
        if ($this->satuanModel->save([
            'id' => $id,
            'satuan' => $satuan
        ])) {
            echo '1';
        }
    }

    public function hapusSatuan($id)
    {
        if ($this->satuanModel->delete($id)) {
            return redirect()->to(base_url('master/satuan'));
        }
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
