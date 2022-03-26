<?php

namespace App\Controllers;

use App\Database\Migrations\Produk;
use App\Database\Migrations\UserRole;
use \App\Models\UsersModel; // Memanggil User Model Dari Class Model
use \App\Models\UserRoleModel;
use \App\Models\TempPenjualanModel;
use \App\Models\ProdukModel;
use \App\Models\PenjualanModel;
use \App\Models\PenjualanDetailModel;
use PhpParser\Node\Expr\Cast\Array_;
use TCPDF;

class Penjualan extends BaseController
{
    protected $usersModel; //Membuat Variabel Untuk Menampung UsersModel
    protected $userRole;
    protected $tempPenjualanModel;
    protected $produkModel;
    protected $penjualanModel;
    protected $penjualanDetailModel;

    public function __construct()
    {
        //Masukkan Users Model Ke Dalam Variabel
        $this->usersModel = new UsersModel();
        $this->userRole = new UserRoleModel();
        $this->tempPenjualanModel = new TempPenjualanModel();
        $this->produkModel = new ProdukModel();
        $this->penjualanModel = new PenjualanModel();
        $this->penjualanDetailModel = new PenjualanDetailModel();
    }

    public function inputPenjualan()
    {
        //cek status login
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'BakeryAPP || Data User',
            'validation' => \Config\Services::validation(),
            'invoice' => $this->buatInvoice()
        ];

        return view('penjualan/inputPenjualan', $data);
    }

    public function buatInvoice()
    {
        //Fungsi Membuat Invoice Penjualan
        $tanggal = date('Y-m-d'); //Ambil Tanggal Hari ini
        $db      = \Config\Database::connect(); //Connect Database 
        $builder = $db->table('penjualan'); //Inisialisasi Tabel
        $builder->selectMax('invoice'); //Untuk Menampilkan Data Numerik Tertinggi dari invoice
        $builder->where('tanggal', $tanggal); //Yg dimana tanggal == tanggal hariini
        $query = $builder->get();
        $hasil = $query->getRowArray();
        $users = $hasil['invoice'];
        $lastNoUrut = substr($users, -4);
        $next = intval($lastNoUrut) + 1;
        $noinvoice = "TRX" . date('dmy', strtotime($tanggal)) . sprintf('%05s', $next);
        return $noinvoice;
    }

    public function detailPenjualan()
    {
        //Ambil Invoice Yang Dikirim AJAX
        $invoice = $this->request->getPost('invoice');

        $db      = \Config\Database::connect();
        $builder = $db->table('temp_penjualan');
        $builder->select('temp_penjualan.id as id_penjualan,temp_penjualan.kode_produk,harga_produk,nama_produk,jumlah,subtotal');
        $builder->join('produk', 'temp_penjualan.kode_produk = produk.kode_produk');
        $builder->where('invoice', $invoice);
        $builder->orderBy('temp_penjualan.id', 'asc');
        $query = $builder->get();
        $hasil = $query->getResultArray();

        $data = [
            'detail' => $hasil
        ];

        $msg = [
            'data' => view('penjualan/detailPenjualan', $data)
        ];

        echo json_encode($msg);
    }

    public function dataProduk()
    {
        //Ambil Data Produk JOIN dengan Kategori Produk
        $db      = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('produk.id,kode_produk,nama_produk,kategori_produk,kategori,stok_produk');
        $builder->join('kategori', 'produk.kategori_produk = kategori.id');
        $builder->where('stok_produk', 1);
        $query = $builder->get();
        $hasil = $query->getResultArray();
        $data = [
            'produk' => $hasil
        ];
        if ($this->request->isAJAX()) {
            //Arahkan Ke View Data Produk
            $msg = [
                'viewmodal' => view('penjualan/dataProduk', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function dataProduk2()
    {
        $kodeproduk = $this->request->getPost('kodeproduk');
        $namaproduk = $this->request->getPost('namaproduk');

        //Ambil Data Produk JOIN dengan Kategori Produk
        $db      = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('produk.id,kode_produk,nama_produk,kategori_produk,kategori,stok_produk');
        $builder->join('kategori', 'produk.kategori_produk = kategori.id');
        $builder->like('kode_produk', $kodeproduk);
        $builder->orLike('nama_produk', $kodeproduk);
        $query = $builder->get();
        $hasil = $query->getResultArray();

        $data = [
            'produk' => $hasil
        ];
        if ($this->request->isAJAX()) {
            //Arahkan Ke View Data Produk
            $msg = [
                'viewmodal' => view('penjualan/dataProduk', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanTemp()
    {
        //Tangkap Data
        $kodeproduk = $this->request->getPost('kodeproduk');
        $namaproduk = $this->request->getPost('namaproduk');
        $jumlah = $this->request->getPost('jumlah');
        $invoice = $this->request->getPost('invoice');
        //Ambil Harga Produknya Dulu
        $infoProduk = $this->produkModel->where(['kode_produk' => $kodeproduk])->first();
        $subtotal = floatval($infoProduk['harga_produk']) * $jumlah;
        //Masukkan Ke Database
        if ($this->tempPenjualanModel->save([
            'invoice' => $invoice,
            'kode_produk' => $kodeproduk,
            'jumlah' => $jumlah,
            'harga_beli' => $infoProduk['modal_produk'],
            'harga_jual' => $infoProduk['harga_produk'],
            'subtotal' => $subtotal
        ])) {
            echo "1";
        }
    }

    public function tampilTotalBayar()
    {

        if ($this->request->isAJAX()) {
            //Kalau ada request dari ajax
            //Tangkap Data Yang Dikirim Ajax
            $invoice = $this->request->getPost('invoice');

            //Jalankan Query SUM untuk jumlah total detailpesanan
            $db      = \Config\Database::connect();
            $builder = $db->table('temp_penjualan');
            $builder->select('SUM(subtotal) as totalbayar');
            $builder->where('invoice', $invoice);
            $query = $builder->get();
            $hasil = $query->getRowArray();

            $msg = [
                'totalbayar' => number_format($hasil['totalbayar'], 0, ",", ".")
            ];
            echo json_encode($msg);
        }
    }

    public function hapusItem()
    {

        if ($this->request->isAJAX()) {
            //Kalau Ada Request Ajax
            //Tangkap Data Dikirim Ajax
            $id = $this->request->getPost('id');

            //Hapus Data Produk Berdasarkan ID 
            if ($this->tempPenjualanModel->delete($id)) {
                echo "sukses";
            }
        }
    }

    public function simpanPenjualan()
    {
        //Ambil Data Ajax
        $kasir  = $this->request->getPost('kasir');
        $invoice = $this->request->getPost('invoice');
        $pelanggan = $this->request->getPost('pelanggan');

        //Cek Apakah Ada Data Detail Penjualannya ?
        $isiTempPenjualan = $this->tempPenjualanModel->where(['invoice' => $invoice])->first();

        //Jalankan Query SUM untuk jumlah total detailpesanan
        $db      = \Config\Database::connect();
        $builder = $db->table('temp_penjualan');
        $builder->select('SUM(subtotal) as totalbayar');
        $builder->where('invoice', $invoice);
        $query = $builder->get();
        $hasil = $query->getRowArray();


        if ($isiTempPenjualan) {
            //Arahkan Ke View Modal Pembayaran
            //Query Total Bayar Dari Tabel TempPenjualan

            $data = [
                'totalbayar' => $hasil['totalbayar'],
                'kasir' => $kasir,
                'invoice' => $invoice,
                'pelanggan' => $pelanggan

            ];

            $msg = [
                'viewmodal' => view('penjualan/modalPembayaran', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanPembayaran()
    {

        //Tangkap Data nya
        $invoice = $this->request->getPost('invoice');
        $pelanggan = $this->request->getPost('pelanggan');
        $kasir = $this->request->getPost('kasir');
        $total =  str_replace(",", "", $this->request->getPost('total_pembayaran'));
        $jumlahUang =  str_replace(",", "", $this->request->getPost('jumlah_uang'));
        $sisaUang =  str_replace(",", "", $this->request->getPost('sisa_uang'));



        //Masukkan Ke Database Penjualan
        if ($this->penjualanModel->save([
            'invoice' => $invoice,
            'tanggal' => date('Y-m-d H:i:s'),
            'pelanggan' => $pelanggan,
            'kasir' => $kasir,
            'jumlah_uang' => $jumlahUang,
            'sisa_uang' => $sisaUang,
            'total' => $total
        ])) {
            // 	//Kalau Berhasil
            // 	//Masukkan Ke Database Penjualan Detail Dari Tabel Temp
            $db      = \Config\Database::connect();
            $builder = $db->table('temp_penjualan');
            $builder->where('invoice', $invoice);
            $query = $builder->get();
            $isiTempPenjualan = $query->getResultArray();

            $DetailPenjualan = [];
            foreach ($isiTempPenjualan as $row) {
                $DetailPenjualan[] = [
                    'invoice' => $row['invoice'],
                    'kode_produk' => $row['kode_produk'],
                    'harga_beli' => $row['harga_beli'],
                    'harga_jual' => $row['harga_jual'],
                    'jumlah' => $row['jumlah'],
                    'subtotal' => $row['subtotal'],
                ];
            }
            $db      = \Config\Database::connect();
            $builder = $db->table('penjualan_detail');
            $builder->insertBatch($DetailPenjualan);

            //Hapus Temp
            $db      = \Config\Database::connect();
            $builder = $db->table('temp_penjualan');
            $builder->emptyTable();

            //Masukkan Data Penjualan Ke Session Untuk Di Cetak Ke Struk
            $dataPenjualan = [
                'invoice' => $invoice,
                'pelanggan' => $pelanggan,
                'kasir' => $kasir,
                'total' => $total,
                'jumlah_uang' => $jumlahUang,
                'sisa_uang' => $sisaUang
            ];
            session()->set($dataPenjualan);

            echo 'berhasil';
        }
    }

    public function hapusPenjualan($id)
    {

        $dataPenjualan = $this->penjualanModel->where(['id' => $id])->first();
        //Hapus Data Yang Ada Di Tabel Penjualan
        $this->penjualanModel->delete($id);
        //Hapus Data Yang Ada Di Tabel Detail Penjualan Berdasarkan Invoice Dari Id yang dipilih
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan_detail');
        $builder->delete(['invoice' => $dataPenjualan['invoice']]);

        return redirect()->to(base_url('penjualan/dataPenjualan'));
    }

    public function dataPenjualan()
    {
        //cek status login
        if (!session()->has('logged_in')) {
            session()->setFlashdata('login', 'Silahkan Login Terlebih Dahulu !');
            return redirect()->to(base_url());
        }

        helper('aqil_helper');

        //Ambil Data Penjualan
        $dataPenjualan = $this->penjualanModel->findAll();

        $data = [
            'title' => 'BakeryAPP || Data Penjualan',
            'dataPenjualan' => $dataPenjualan
        ];

        return view('penjualan/dataPenjualan', $data);
    }
    public function laporanPenjualan()
    {

        //Ambil Data Tanggal Cetak
        $tanggalAwal = $this->request->getPost('tanggal_cetak');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');

        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->where('tanggal >=', $tanggalAwal);
        $builder->where('tanggal <=', $tanggalAkhir);
        $query = $builder->get();
        $laporanPenjualan = $query->getResultArray();

        //Menghitung Total Penjualan Pada Tanggal Tersebut
        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan');
        $builder->select('SUM(total) as totalpenjualan');
        $builder->where('tanggal >=', $tanggalAwal);
        $builder->where('tanggal <=', $tanggalAkhir);
        $query = $builder->get();
        $hasil = $query->getRowArray();
        $totalPenjualan = $hasil['totalpenjualan'];


        if ($laporanPenjualan) {

            //Jika ada datanya maka cetak pdf nya
            $data = [
                'laporan' => $laporanPenjualan,
                'tanggalawal' => $tanggalAwal,
                'tanggalakhir' => $tanggalAkhir,
                'total_penjualan' => $totalPenjualan
            ];
            $html = view('penjualan/laporanPenjualan', $data);

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
            $pdf->Output('laporan-penjualan.pdf', 'D');
        } else {
            //Jika data nya gak ada kirimkan pesan kosong
            echo "kosong";
        }
    }

    public function laporanPengeluaran()
    {

        //Jika ada datanya maka cetak pdf nya
        $data = [];
        $html = view('penjualan/laporanPengeluaran');

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
        $pdf->Output('LaporanPengeluaran.pdf', 'I');
    }
}
