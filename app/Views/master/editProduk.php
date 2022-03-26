<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<?php
foreach ($satuan as $sat) {
    $namasatuan = $sat['satuan'];
}
foreach ($kategori as $kat) {
    $namakategori = $kat['kategori'];
}
?>
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
                        <h4 class="card-title">Data Edit Produk</h4>
                        <a href="<?= base_url(); ?>/master/produk" class="btn btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">
                            <form action="<?= base_url(); ?>/master/updateProduk/<?= $produk['id']; ?>" method="POST" class="form-produk" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" value="<?= $produk['foto_produk']; ?>" name="fotoLama">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="" style="font-weight: bold;">Kode Produk</label>
                                        <input type="text" style="border: 1px solid #000000;" name="kode_produk" value="<?= $produk['kode_produk']; ?>" class="form-control input-rounded" readonly>

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label for="" style="font-weight: bold;">Nama Produk</label>
                                        <input type="text" style="border: 1px solid #000000;" name="nama_produk" value="<?= $produk['nama_produk']; ?>" class="form-control input-rounded <?= ($validation->hasError('nama_produk') ? 'is-invalid' : ''); ?>" placeholder="Masukkan Nama Produk...">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_produk'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <label for="inputState" style="font-weight: bold;">Satuan</label>
                                        <select id="inputState" class="form-control" name="satuan_produk">

                                            <?php foreach ($satuan as $s) :  ?>
                                                <?php if ($s['id'] == $produk['satuan_produk']) : ?>
                                                    <option value="<?= $s['id']; ?>" selected><?= $s['satuan']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $s['id']; ?>"><?= $s['satuan']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="inputState" style="font-weight: bold;">Kategori</label>
                                        <select id="inputState" class="form-control" name="kategori_produk">
                                            <?php foreach ($kategori as $k) :  ?>
                                                <?php if ($k['id'] == $produk['kategori_produk']) : ?>
                                                    <option value="<?= $k['id']; ?>" selected><?= $k['kategori']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="inputState" style="font-weight: bold;">Stok</label>

                                        <select id="inputState" class="form-control" name="stok_produk">
                                            <option selected value="<?= $produk['stok_produk']; ?>"><?= ($produk['stok_produk'] == 1 ? 'Tersedia' : 'Tidak Tersedia'); ?></option>
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
                                            <input type="text" name="modal_produk" value="<?= $produk['modal_produk']; ?>" class="form-control input-rounded <?= ($validation->hasError('modal_produk') ? 'is-invalid' : ''); ?>" id="modal" placeholder="Masukkan Modal ..." aria-describedby="addon-wrapping">

                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="inputState" style="font-weight: bold;">Harga Jual</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="text" name="harga_produk" id="harga_jual" value="<?= $produk['harga_produk']; ?>" class="form-control input-rounded <?= ($validation->hasError('harga_produk') ? 'is-invalid' : ''); ?>" placeholder="Masukkan Harga Jual..." aria-describedby="addon-wrapping">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label for="" style="font-weight: bold;">Keterangan Produk</label>
                                        <input type="text" style="border: 1px solid #000000;" name="keterangan_produk" value="<?= $produk['keterangan_produk']; ?>" class="form-control input-rounded" placeholder="Masukkan keterangan Produk...">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <img src="<?= base_url('assets'); ?>/images/product/<?= $produk['foto_produk']; ?>" class="img img-thumbnail" width="200px" alt="">
                                    </div>
                                    <div class="form-group col-lg-8">
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