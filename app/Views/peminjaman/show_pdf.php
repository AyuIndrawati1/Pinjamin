<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman Laptop</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #111827;
        }

        .nota-container {
            width: 100%;
            margin: auto;
            padding: 20px;
        }

        .nota-header {
            text-align: center;
            border-bottom: 2px dashed #d1d5db;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .nota-header h2 {
            margin: 5px 0;
            font-size: 20px;
        }

        .nota-header small {
            font-size: 12px;
            color: #6b7280;
        }

        .logo {
            margin-bottom: 8px;
        }

        .logo img {
            width: 70px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border: 1px solid #e5e7eb;
        }

        th {
            width: 35%;
            background: #f3f4f6;
        }

        .nota-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 2px dashed #d1d5db;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="nota-container">
        <div class="nota-header">
            <div class="logo">
                <!-- LOGO base64 dari controller -->
                <img src="<?= $logo ?>" alt="Logo">
            </div>
            <h2>Detail Peminjaman Laptop</h2>
            <small>Badan Pusat Statistik Kabupaten Malang</small>
        </div>

        <table>
            <tr>
                <th>Nama Peminjam</th>
                <td><?= esc($peminjaman['nama_peminjam']) ?></td>
            </tr>
            <tr>
                <th>Merk Laptop</th>
                <td><?= esc($peminjaman['merk_laptop']) ?></td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td><?= esc($peminjaman['tgl_pinjam']) ?></td>
            </tr>
            <tr>
                <th>Rencana Kembali</th>
                <td><?= esc($peminjaman['rencana_kembali']) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= esc($peminjaman['status']) ?></td>
            </tr>
            <tr>
                <th>Petugas Peminjam</th>
                <td><?= isset($peminjaman['petugas_pinjam']) ? esc($peminjaman['petugas_pinjam']) : '-' ?></td>
            </tr>
            <tr>
                <th>Petugas Kembali</th>
                <td><?= isset($peminjaman['petugas_kembali']) ? esc($peminjaman['petugas_kembali']) : '-' ?></td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td><?= isset($peminjaman['keperluan']) ? esc($peminjaman['keperluan']) : '-' ?></td>
            </tr>
        </table>

        <div class="nota-footer">
            <p>Terima kasih telah menggunakan layanan pinjamin.</p>
        </div>
    </div>
</body>

</html>