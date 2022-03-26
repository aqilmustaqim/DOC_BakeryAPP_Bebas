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
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div style="font-size:35px; font-family: Verdana, Geneva, Tahoma, sans-serif; text-align: center; text-shadow: black; font-weight: bold;">Bakery APP</div>
    <hr>
    <div style="text-align: center;">
        <h1><i>Laporan Kas Keluar</i></h1><br>
        Kas Keluar Pada Tanggal : <?= $tanggalawal; ?> - <?= $tanggalakhir; ?><br>
        Total Kas Keluar : <strong> <?= number_format($total_nominal); ?> </strong>
        </p>
    </div>
    <table cellpadding="6">
        <tr style="background-color: steelblue; color:white">
            <th><strong>No</strong></th>
            <th><strong>Keterangan</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Nominal</strong></th>
        </tr>
        <?php $nomor = 1; ?>
        <?php foreach ($laporan as $l) : ?>

            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $l['keterangan']; ?></td>
                <td><?= $l['tanggal']; ?></td>
                <td><?= number_format($l['nominal']);  ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>