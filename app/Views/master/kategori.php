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
                        <h4 class="card-title">Data Kategori</h4>
                        <button class="btn btn-info" data-toggle="modal" data-target="#TambahDataKategori"><i class="fa fas fa-user-plus"></i>Tambah Data Kategori</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php foreach ($kategori as $k) : ?>
                                        <tr>
                                            <td><?= $nomor++; ?></td>
                                            <td><button class="badge badge-black"><?= $k['kategori']; ?></button></td>
                                            <td>

                                                <a href="<?= base_url(); ?>/master/hapusKategori/<?= $k['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></a>

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
<div class="modal fade" id="TambahDataKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>

            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Nama Kategori</label>
                        <input type="text" id="kategori" name="nama_kategori" class="form-control" placeholder="Masukkan Kategori..." required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombol-tambah-kategori">Tambah</button>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>