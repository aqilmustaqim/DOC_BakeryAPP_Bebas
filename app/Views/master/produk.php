<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Produk</h4>
                        <div class="produk" data-produk="<?= session()->getFlashdata('produk'); ?>"></div>
                        <a href="<?= base_url(); ?>/master/formProduk" class="btn btn-info"><i class="fa fas fa-user-plus"></i>Tambah Data produk</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Modal</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($produk as $p) : ?>
                                        <tr>
                                            <td>
                                                <img class="img img-thumbnail" src="<?= base_url('assets'); ?>/images/product/<?= $p['foto_produk']; ?>" width="100px" alt="">
                                            </td>
                                            <td><?= $p['kode_produk']; ?></td>
                                            <td><?= $p['nama_produk']; ?></td>
                                            <td>Rp.<?= number_format($p['modal_produk']); ?></td>
                                            <td>Rp.<?= number_format($p['harga_produk']); ?></td>
                                            <td>
                                                <?= ($p['stok_produk'] == 1 ? '<button class="badge badge-success">Tersedia</button>' : '<button class="badge badge-danger">Tidak Tersedia</button>') ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url(); ?>/master/editProduk/<?= $p['id']; ?>" class="badge badge-info"><i class="fa fas fa-edit"></i></a>
                                                <a href="<?= base_url(); ?>/master/hapusProduk/<?= $p['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></i></a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--**********************************
            Content body end
***********************************-->
<?= $this->endSection(); ?>