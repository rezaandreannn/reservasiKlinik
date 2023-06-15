<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;

        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Nama Klinik</h1>
        <p>Alamat Klinik</p>
    </div>



    <table>
        <thead>
            <tr>
                <th>Harga</th>
                <th>Jenis Treatment</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authReservasi as  $value) : ?>
            <tr>
                <td>Rp. <?= format_rupiah($value->jumlah_bayar) ?></td>
                <td><?= $value->nama_treatment ?></td>
                <td><?= date('d/m/Y', strtotime($value->updated_at)) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <script>
        window.print();
    </script>
</body>

</html>