<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            height: 20px;
            margin: 6px;
            font-size: 9px;
        }
    </style>
</head>

<body>
    <div style="font-size:35px; font-family: Verdana, Geneva, Tahoma, sans-serif; text-align: center; text-shadow: black; font-weight: bold;">BakeryAPP</div>
    <hr>
    <div style="text-align: center;">
        <h1><i>Laporan Penjualan</i></h1><br>
        Penjualan Pada Tanggal : <?= $tanggalawal; ?> - <?= $tanggalakhir; ?><br>
        Total Penjualan : <strong> <?= number_format($total_penjualan); ?> </strong>
        </p>
    </div>
    <table cellpadding="6">
        <tr style="background-color: steelblue; color:white">
            <th><strong>No</strong></th>
            <th><strong>Invoice</strong></th>
            <th><strong>Pelanggan</strong></th>
            <th><strong>Kasir</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Total Harga</strong></th>
        </tr>
        <?php $nomor = 1; ?>
        <?php foreach ($laporan as $l) : ?>

            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $l['invoice']; ?></td>
                <td><?= $l['pelanggan']; ?></td>
                <td><?= $l['kasir']; ?></td>
                <td><?= $l['tanggal']; ?></td>
                <td><?= number_format($l['total']);  ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>