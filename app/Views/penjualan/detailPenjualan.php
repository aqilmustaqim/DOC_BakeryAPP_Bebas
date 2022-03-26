<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-info">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>SubTotal</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($detail as $d) :  ?>
                <?php $subtotal = $d['jumlah'] * $d['harga_produk']; ?>
                <tr>
                    <td><button class="badge badge-dark"><?= $nomor++; ?></button></td>
                    <td><?= $d['kode_produk']; ?></td>
                    <td><?= $d['nama_produk']; ?></td>
                    <td><?= $d['jumlah']; ?></td>
                    <td><?= number_format($d['harga_produk'], 0, ",", "."); ?></td>
                    <td><?= number_format($d['subtotal'], 0, ",", "."); ?> </td>
                    <td>
                        <button class="badge badge-danger" onclick="hapusItem('<?= $d['id_penjualan']; ?>','<?= $d['nama_produk']; ?>')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>


    </table>
</div>