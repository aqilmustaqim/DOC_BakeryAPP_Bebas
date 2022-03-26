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
                        <h4 class="card-title">Data Penjualan</h4>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalDataPenjualan">Cetak Data Penjualan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Kasir</th>
                                        <th>Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php foreach ($dataPenjualan as $dp) : ?>
                                        <tr>
                                            <td>
                                                <button class="badge badge-grey"><?= $nomor++; ?></button>

                                            </td>
                                            <td><?= $dp['invoice']; ?></td>
                                            <td>
                                                <button class="badge badge-info"><?= $dp['kasir']; ?></button>

                                            </td>
                                            <td><?= $dp['pelanggan']; ?></td>
                                            <td><?= $dp['tanggal']; ?></td>
                                            <td>
                                                <button class="badge badge-success"><?= number_format($dp['total']); ?></button>

                                            </td>

                                            <td>

                                                <button type="button" class="badge badge-primary" data-toggle="modal" data-target="#InvoicePenjualan<?= $dp['invoice']; ?>">++</button>
                                                <a href="<?= base_url(); ?>/penjualan/hapusPenjualan/<?= $dp['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></i></a>
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

<!-- Modal Cetak Data Penjualan -->
<div class="modal fade" id="modalDataPenjualan">
    <div class="modal-dialog">
        <form action="<?= base_url('penjualan/laporanPenjualan'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Pilih Tanggal Awal</label>
                            <input type="date" id="tanggal_cetak" name="tanggal_cetak" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pilih Tanggal Akhir</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak Data</button>
                    <!-- tombol-cetak-penjualan -->
                </div>
        </form>
    </div>
</div>
</div>


<?php foreach ($dataPenjualan as $dp) : ?>
    <div class="modal fade" id="InvoicePenjualan<?= $dp['invoice']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Penjualan <button class="badge badge-info"><?= $dp['invoice']; ?></button> </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>

                <div class="modal-body">

                    <?php $detailpenjualan = detail_penjualan($dp['invoice']); ?>
                    <table class="table table-hovered">
                        <thead style="background-color: seagreen; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <?php foreach ($detailpenjualan as $d) : ?>
                            <tbody style="font-weight: normal; color: black;">
                                <!-- Perulangan Data Menu Psanan -->
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama_produk']; ?></td>
                                <td><?= number_format($d['harga_produk']); ?></td>
                                <td><?= $d['jumlah']; ?></td>
                                <td><?= number_format($d['subtotal']); ?></td>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>


<?= $this->endSection(); ?>