<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">✏ Edit Peminjaman Laptop</h4>
                    <a href="<?= site_url('peminjaman') ?>" class="btn btn-sm btn-primary">Kembali</a>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- FORM UPDATE -->
                <form action="<?= site_url('peminjaman/update/' . $peminjaman['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Peminjam Laptop *</label>
                            <input type="text" name="nama_peminjam" class="form-control"
                                value="<?= esc($peminjaman['nama_peminjam']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Merk Laptop yang Dipinjam *</label>
                            <select name="merk_laptop" class="form-select" required>
                                <option value="">Pilih merk laptop</option>
                                <option value="Asus" <?= $peminjaman['merk_laptop'] == 'Asus' ? 'selected' : '' ?>>Asus</option>
                                <option value="HP" <?= $peminjaman['merk_laptop'] == 'HP' ? 'selected' : '' ?>>HP</option>
                                <option value="Lenovo" <?= $peminjaman['merk_laptop'] == 'Lenovo' ? 'selected' : '' ?>>Lenovo</option>
                                <option value="Acer" <?= $peminjaman['merk_laptop'] == 'Acer' ? 'selected' : '' ?>>Acer</option>
                            </select>
                        </div>

                        <!-- Tanggal Peminjaman -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Peminjaman Laptop *</label>
                            <input type="text" name="tgl_pinjam" class="form-control datepicker"
                                value="<?= $peminjaman['tgl_pinjam'] ? date('d/m/Y', strtotime($peminjaman['tgl_pinjam'])) : date('d/m/Y') ?>"
                                required autocomplete="off">
                        </div>

                        <!-- Tanggal Rencana Pengembalian -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Rencana Pengembalian *</label>
                            <input type="text" name="rencana_kembali" class="form-control datepicker"
                                value="<?= $peminjaman['rencana_kembali'] ? date('d/m/Y', strtotime($peminjaman['rencana_kembali'])) : '' ?>"
                                required autocomplete="off">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Petugas yang Melayani *</label>
                            <input type="text" name="petugas_pinjam" class="form-control"
                                value="<?= esc($peminjaman['petugas_pinjam']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Petugas yang Menerima Laptop</label>
                            <input type="text" name="petugas_kembali" class="form-control"
                                value="<?= esc($peminjaman['petugas_kembali']) ?>">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Keperluan Peminjaman Laptop *</label>
                            <textarea name="keperluan" class="form-control" required><?= esc($peminjaman['keperluan']) ?></textarea>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengembalian Laptop</label>
                            <input type="text" name="tgl_kembali" class="form-control datepicker"
                                value="<?= $peminjaman['tgl_kembali'] ? date('d/m/Y', strtotime($peminjaman['tgl_kembali'])) : '' ?>"
                                autocomplete="off">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                        <a href="<?= site_url('peminjaman') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JQuery & Bootstrap Datepicker JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                todayHighlight: true,
                autoclose: true,
                language: "id"
            });
        });
    </script>
</body>

</html>