<?php

namespace App\Controllers;

use TCPDF;
use App\Database\Migrations\UserRole;
use \App\Models\UsersModel; // Memanggil User Model Dari Class Model
use \App\Models\UserRoleModel;
use \App\Models\KategoriModel;
use \App\Models\SatuanModel;
use \App\Models\ProdukModel;
use \App\Models\KasKeluarModel;

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
            'title' => 'BakeryAPP || Produk',
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
            'title' => 'BakeryAPP || Form Produk',
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

    public function editProduk($id)
    {
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        } else {
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url('kasir'));
            }
        }

        $produk = $this->produkModel->where(['id' => $id])->first();
        $satuan = $this->satuanModel->findAll();
        $kategori = $this->kategoriModel->findAll();


        $data = [
            'title' => 'BakeryAPP || Form Produk',
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori,
            'satuan' => $satuan,
            'produk' => $produk
        ];

        return view('master/editProduk', $data);
    }

    public function updateProduk($id)
    {
        //Validasi Field Dlu
        if (!$this->validate([
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
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
                'rules' => 'mime_in[foto_produk,image/jpg,image/jpeg,image/png]|is_image[foto_produk]',
                'errors' => [
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar ! ',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar ! '
                ]
            ],
        ])) {
            //Kalau Gak Lulus Validasi
            return redirect()->to(base_url("master/editProduk/$id"))->withInput();
        }

        //Kalau Lolos Validasi
        //1. Cek Foto Di Ubah Atau Tidak
        $fileFoto = $this->request->getFile('foto_produk');
        $fotoLama = $this->request->getVar('fotoLama');
        if ($fileFoto->getError() == 4) {
            //Ambil Nama Foto Lamanya
            $namaFoto = $fotoLama;
        } else {
            //Kalau Foto Nya Diubah
            //Ambil Nama File Foto Barunya
            $namaFoto = $fileFoto->getRandomName();
            //Masukkan Ke Dalam Folder Image
            $fileFoto->move('assets/images/product', $namaFoto);
            //Hapus File Foto Lama
            unlink("assets/images/product/$fotoLama");
        }
        //Update Data Di Database
        if ($this->produkModel->save([
            'id' => $id,
            'nama_produk' => $this->request->getVar('nama_produk'),
            'satuan_produk' => $this->request->getVar('satuan_produk'),
            'kategori_produk' => $this->request->getVar('kategori_produk'),
            'modal_produk' => str_replace(',', '', $this->request->getVar('modal_produk')),
            'harga_produk' => str_replace(',', '', $this->request->getVar('harga_produk')),
            'stok_produk' => $this->request->getVar('stok_produk'),
            'keterangan_produk' => $this->request->getVar('keterangan_produk'),
            'foto_produk' => $namaFoto
        ])) {
            session()->setFlashdata('produk', 'DiUbah');
            return redirect()->to(base_url('master/produk'));
        }
    }

    public function hapusProduk($id)
    {

        //Ambil Data Produk Berdasarkan Id Yang mau dihapus
        $dataProduk = $this->produkModel->where(['id' => $id])->first();
        $foto = $dataProduk['foto_produk'];
        //Langsung Hapus Datanya
        if ($this->produkModel->delete($id)) {
            //Hapus Juga Gambar Yang Ada Di Folder
            unlink("assets/images/product/$foto");

            return redirect()->to(base_url('master/produk'));
        }
    }

    public function kasKeluar()
    {
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        } else {
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url('kasir'));
            }
        }

        $kasKeluar = $this->kasKeluarModel->findAll();


        $data = [
            'title' => 'BakeryAPP || Kas Keluar',
            'validation' => \Config\Services::validation(),
            'kasKeluar' => $kasKeluar
        ];

        return view('master/kasKeluar', $data);
    }

    public function tambahKasKeluar()
    {
        //Tangkap Data
        $keterangan = $this->request->getVar('keterangan');
        $tanggal = $this->request->getVar('tanggal');
        $nominal = $this->request->getVar('nominal');

        //Masukkan Ke Database 
        if ($this->kasKeluarModel->save([
            'keterangan' => $keterangan,
            'tanggal' => $tanggal,
            'nominal' => str_replace(',', '', $nominal)
        ])) {
            echo '1';
        }
    }

    public function hapusKasKeluar($id)
    {
        //Hapus
        if ($this->kasKeluarModel->delete($id)) {
            return redirect()->to(base_url('master/kasKeluar'));
        }
    }
    public function laporanKasKeluar()
    {

        //Ambil Data Tanggal Cetak
        $tanggalAwal = $this->request->getPost('tanggal_awal');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');

        //Query Database
        $db      = \Config\Database::connect();
        $builder = $db->table('kas_keluar');
        $builder->where('tanggal >=', $tanggalAwal);
        $builder->where('tanggal <=', $tanggalAkhir);
        $query = $builder->get();
        $laporanKasKeluar = $query->getResultArray();



        //Menghitung Total Penjualan Pada Tanggal Tersebut
        $db      = \Config\Database::connect();
        $builder = $db->table('kas_keluar');
        $builder->select('SUM(nominal) as totalnominal');
        $builder->where('tanggal >=', $tanggalAwal);
        $builder->where('tanggal <=', $tanggalAkhir);
        $query = $builder->get();
        $hasil = $query->getRowArray();
        $totalNominal = $hasil['totalnominal'];

        if ($laporanKasKeluar) {

            //Jika ada datanya maka cetak pdf nya
            $data = [
                'laporan' => $laporanKasKeluar,
                'tanggalawal' => $tanggalAwal,
                'tanggalakhir' => $tanggalAkhir,
                'total_nominal' => $totalNominal
            ];
            $html = view('master/laporanKasKeluar', $data);

            //$pdf = new TCPDF('P', 'mm', array('58', '30'), true, 'UTF-8', false);
            //$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            //Informasi Dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Aqil Mustaqim');
            $pdf->SetTitle('Laporan Penjualan');
            $pdf->SetSubject('Laporan Penjualan');

            //Header Dan Footer Data
            //$pdf->setHeaderData('/assets/images/1.jpg', 1, 'BakeryAPP', 'JL. Gaperta No 433', array(48, 89, 112), array(48, 89, 112));
            //$pdf->setFooterData(array(0, 0, 0), array(0, 0, 0));
            //$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            //$pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            //Set Margin
            //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            //$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

            //Baris Baru
            //$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

            //Set Scaling Image
            //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            //Font Subsetting
            //$pdf->setFontSubsetting(true);

            //Font Utama
            //$pdf->SetFont('helvetica', '', 12, '', true);

            $pdf->addPage();

            // output the HTML content
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $pdf->writeHTML($html, true, false, true, false, '');
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            //$pdf->writeHTML($html, true, false, true, false, '');
            //line ini penting
            $this->response->setContentType('application/pdf');
            //Close and output PDF document
            $pdf->Output('laporan-kas-keluar.pdf', 'I');
        } else {
            //Jika data nya gak ada kirimkan pesan kosong
            echo "Gak Ada Laporan qil";
        }
    }
}
