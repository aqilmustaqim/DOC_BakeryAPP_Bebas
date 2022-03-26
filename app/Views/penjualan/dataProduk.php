<!-- Modal -->
<div class="modal fade" id="modalproduk" tabindex="-1" aria-labelledby="modalprodukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalprodukLabel">Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="table-responsive">
                <table class="table table-sm mb-0 table-striped">

                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php foreach ($produk as $p) : ?>
                            <tr>
                                <td><button class="badge badge-grey"><?= $nomor++; ?></button></td>
                                <td><?= $p['kode_produk']; ?></td>
                                <td><?= $p['nama_produk']; ?></td>
                                <td><?= $p['kategori']; ?></td>
                                <td>
                                    <button class="badge badge-success">Tersedia</button>
                                </td>
                                <td>
                                    <button class="badge badge-primary" type="button" onclick="pilihProduk('<?= $p['kode_produk']; ?>','<?= $p['nama_produk']; ?>')">Pilih</button>
                                </td>
                            </tr>


                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function pilihProduk(kode, nama) {

        //Masukkan Kode Produk Dan Nama Produk Ke Inputan 
        $('#kodeproduk').val(kode);
        $('#namaproduk').val(nama);

        //Hide Modal
        $('#modalproduk').modal('hide');

    }
</script>