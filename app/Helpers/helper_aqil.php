<!-- Fungsi Detail Penjualan -->
<?php
function detail_penjualan($invoice)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('penjualan_detail');
    $builder->select('penjualan_detail.id as id_penjualan,penjualan_detail.kode_produk,harga_produk,nama_produk,jumlah,subtotal');
    $builder->join('produk', 'penjualan_detail.kode_produk = produk.kode_produk');
    $builder->where('invoice', $invoice);
    $builder->orderBy('penjualan_detail.id', 'asc');
    $query = $builder->get();
    $hasil = $query->getResultArray();
    return $hasil;
}



?>