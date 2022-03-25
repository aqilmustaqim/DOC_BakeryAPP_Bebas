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
                        <h4 class="card-title">Data Satuan</h4>
                        <button class="btn btn-info" data-toggle="modal" data-target="#TambahDataSatuan"><i class="fa fas fa-user-plus"></i>Tambah Data Satuan</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php foreach ($satuan as $k) : ?>
                                        <tr>
                                            <td><?= $nomor++; ?></td>
                                            <td><?= $k['satuan']; ?></td>
                                            <td>

                                                <a href="<?= base_url(); ?>/master/hapusSatuan/<?= $k['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></a>

                                            </td>
                                        </tr>
                                </tbody>
                            <?php endforeach; ?>
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
<div class="modal fade" id="TambahDataSatuan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Satuan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>

            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Nama Satuan</label>
                        <input type="text" id="satuan" name="nama_satuan" class="form-control" placeholder="Masukkan Satuan..." required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombol-tambah-satuan">Tambah</button>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>