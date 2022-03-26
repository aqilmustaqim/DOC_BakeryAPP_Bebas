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
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        } else {
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url('kasir'));
            }
        }

        //Query JOIN TABEL PRODUK DAN KATEGORI
        $db      = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('produk.*, kategori.kategori');
        $builder->join('kategori', 'produk.kategori_produk = kategori.id');
        $query = $builder->get();
        $produk = $query->getResultArray();
        $data = [
            'title' => 'PosCafe || Produk',
            'validation' => \Config\Services::validation(),
            'produk' => $produk
        ];

        return view('master/produk', $data);
    }

    public function formProduk()
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
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'PosCafe || Form Produk',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori,
            'satuan' => $satuan
        ];

        return view('master/formProduk', $data);
    }

    public function tambahProduk()
    {
        //Validasi Field Dlu
        if (!$this->validate([
            'kode_produk' => [
                'rules' => 'required|is_unique[produk.kode_produk]',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! ',
                    'is_unique' => '{field} Sudah Dipakai'
                ]
            ],
            'modal_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'harga_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'foto_produk' => [
                'rules' => 'uploaded[foto_produk]|mime_in[foto_produk,image/jpg,image/jpeg,image/png]|is_image[foto_produk]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi ! ',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar ! ',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar ! '
                ]
            ],
        ])) {
            //Kalau Gak Lulus Validasi
            return redirect()->to(base_url('master/formProduk'))->withInput();
        }
        //Kalau Sudah Lolos Validasi
        //1. Masukkan File foto Ke Dalam Folder
        $fileFoto = $this->request->getFile('foto_produk');
        //Ambil Namanya
        $namaFileFoto = $fileFoto->getRandomName();
        //Masukkan Ke Folder
        $fileFoto->move('assets/images/product', $namaFileFoto);

        //2. Masukkan Data Ke Dalam Database
        if ($this->produkModel->save([
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'satuan_produk' => $this->request->getVar('satuan_produk'),
            'kategori_produk' => $this->request->getVar('kategori_produk'),
            'modal_produk' => str_replace(',', '', $this->request->getVar('modal_produk')),
            'harga_produk' => str_replace(',', '', $this->request->getVar('harga_produk')),
            'stok_produk' => $this->request->getVar('stok_produk'),
            'keterangan_produk' => $this->request->getVar('keterangan_produk'),
            'foto_produk' => $namaFileFoto
        ])) {
            //Kalau Berhail
            session()->setFlashdata('produk', 'Ditambahkan');
            return redirect()->to(base_url('master/formProduk'));
        }
    }
}
