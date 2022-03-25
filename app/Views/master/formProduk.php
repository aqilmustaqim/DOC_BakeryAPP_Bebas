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
                        <h4 class="card-title">Data produk</h4>
                        <div class="produk" data-produk="<?= session()->getFlashdata('produk'); ?>"></div>
                        <a href="<?= base_url(); ?>/master/produk" class="btn btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">
                            <form action="<?= base_url(); ?>/master/tambahProduk" method="POST" class="form-produk" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="" style="font-weight: bold;">Kode Produk</label>
                                        <input type="text" style="border: 1px solid #000000;" name="kode_produk" class="form-control input-rounded <?= ($validation->hasError('kode_produk') ? 'is-invalid' : ''); ?>" placeholder="Masukkan Kode Produk..." autofocus>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kode_produk'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label for="" style="font-weight: bold;">Nama Produk</label>
                                        <input type="text" style="border: 1px solid #000000;" name="nama_produk" class="form-control input-rounded" placeholder="Masukkan Nama Produk...">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <label for="inputState" style="font-weight: bold;">Satuan</label>
                                        <select id="inputState" class="form-control" name="satuan_produk">
                                            <?php foreach ($satuan as $s) :  ?>
                                                <option value="<?= $s['id']; ?>"><?= $s['satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="inputState" style="font-weight: bold;">Kategori</label>
                                        <select id="inputState" class="form-control" name="kategori_produk">
                                            <?php foreach ($kategori as $k) :  ?>
                                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="inputState" style="font-weight: bold;">Stok</label>
                                        <select id="inputState" class="form-control" name="stok_produk">
                                            <option value="1">Tersedia</option>
                                            <option value="0">Tidak Tersedia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="inputState" style="font-weight: bold;">Modal</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="text" name="modal_produk" class="form-control input-rounded <?= ($validation->hasError('modal_produk') ? 'is-invalid' : ''); ?>" id="modal" placeholder="Masukkan Modal ..." aria-describedby="addon-wrapping">

                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="inputState" style="font-weight: bold;">Harga Jual</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="text" name="harga_produk" id="harga_jual" class="form-control input-rounded <?= ($validation->hasError('harga_produk') ? 'is-invalid' : ''); ?>" placeholder="Masukkan Harga Jual..." aria-describedby="addon-wrapping">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label for="" style="font-weight: bold;">Keterangan Produk</label>
                                        <input type="text" style="border: 1px solid #000000;" name="keterangan_produk" class="form-control input-rounded" placeholder="Masukkan keterangan Produk...">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label for="" style="font-weight: bold;">Foto Produk</label>
                                        <input type="file" name="foto_produk" class="form-control <?= ($validation->hasError('foto_produk') ? 'is-invalid' : ''); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('foto_produk'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
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