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
                        <h4 class="card-title">Data Kas Keluar</h4>
                        <button class="btn btn-info" data-toggle="modal" data-target="#TambahKasKeluar"><i class="fa fas fa-user-plus"></i>Tambah Data Kas Keluar</button>
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalKasKeluar">Cetak Kas Keluar</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php foreach ($kasKeluar as $kk) : ?>
                                        <tr>
                                            <td><button class="badge badge-grey"><?= $nomor++; ?></button></td>
                                            <td><?= $kk['keterangan']; ?></td>
                                            <td><button class="badge badge-black"><?= $kk['tanggal']; ?></button></td>
                                            <td><button class="badge badge-primary"><?= number_format($kk['nominal']); ?></button></td>
                                            <td>

                                                <a href="<?= base_url(); ?>/master/hapusKasKeluar/<?= $kk['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></i></a>

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
<div class="modal fade" id="modalKasKeluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master/laporanKasKeluar'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Kas Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Pilih Tanggal Awal</label>
                            <input type="date" id="tanggal_cetak" name="tanggal_awal" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pilih Tanggal Akhir</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="TambahKasKeluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kas Keluar</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>

            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Keterangan</label>
                        <input type="text" id="keterangan_kas" name="keterangan_kas" class="form-control" placeholder="Masukkan Keterangan..." required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal</label>
                        <input type="date" id="tanggal_kas" name="tanggal_kas" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Nominal</label>
                        <input type="text" id="nominal_kas" name="nominal_kas" class="form-control" placeholder="Masukkan Nominal..." required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombol-tambah-kaskeluar">Tambah</button>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>