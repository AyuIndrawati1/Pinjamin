<?= $this->include('layout/header') ?>

<style>
    body {
        background: #f3f4f6;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .nota-container {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .nota-header {
        text-align: center;
        border-bottom: 2px dashed #d1d5db;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .nota-header h2 {
        margin: 0;
        font-size: 26px;
        color: #1f2937;
    }

    .nota-header small {
        color: #6b7280;
        font-size: 14px;
    }

    .nota-table {
        width: 100%;
        border-collapse: collapse;
    }

    .nota-table th,
    .nota-table td {
        text-align: left;
        padding: 10px;
    }

    .nota-table th {
        width: 35%;
        color: #374151;
        font-weight: 600;
    }

    .nota-table td {
        color: #111827;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .nota-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 14px;
        color: #6b7280;
        border-top: 2px dashed #d1d5db;
        padding-top: 15px;
    }

    .btn-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }

    .btn-custom {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px;
        font-size: 15px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-back {
        background: #2563eb;
        color: #fff;
    }

    .btn-back:hover {
        background: #1e40af;
    }

    .btn-pdf {
        background: #dc2626;
        color: #fff;
    }

    .btn-pdf:hover {
        background: #991b1b;
    }
</style>

<div class="nota-container">
    <div class="nota-header">

        <h2>Detail Peminjaman Laptop</h2>
        <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="width:30px; height:30px; margin-right:10px; border-radius:6px;">
        <small>Badan Pusat Statistik Kabupaten Malang</small>
    </div>

    <table class="nota-table">
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

    <div class="btn-actions">
        <a href="<?= site_url('peminjaman') ?>" class="btn-custom btn-back">
            ← Kembali
        </a>
        <a href="<?= base_url('peminjaman/cetak/' . $peminjaman['id']) ?>"
            class="btn btn-danger" target="_blank">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>

    </div>
</div>

<?= $this->include('layout/footer') ?>