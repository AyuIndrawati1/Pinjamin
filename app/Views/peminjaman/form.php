<!-- app/Views/peminjaman/form.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($item) ? 'Edit' : 'Tambah' ?> Peminjaman Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0"><span class="text-primary">+</span> Form Peminjaman Laptop</h4>
                    <a href="<?= site_url('peminjaman') ?>" class="btn btn-sm btn-primary">Tutup Form</a>
                </div>

                <form method="post" action="<?= isset($item) ? site_url('peminjaman/update/' . $item['id']) : site_url('peminjaman/store') ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Peminjam Laptop *</label>
                            <select name="nama_peminjam" class="form-select" required>
                                <option value="">Pilih nama peminjam</option>
                                <?php if (!empty($pegawaiList)): ?>
                                    <?php foreach ($pegawaiList as $pegawai): ?>
                                        <option value="<?= esc($pegawai['nama']) ?>"
                                            <?= (isset($item) && $item['nama_peminjam'] == $pegawai['nama']) ? 'selected' : '' ?>>
                                            <?= esc($pegawai['nama']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Merk Laptop yang Dipinjam *</label>
                            <select name="merk_laptop" class="form-select" required>
                                <option value="">Pilih merk laptop</option>
                                <option value="Asus" <?= (isset($item) && $item['merk_laptop'] == 'Asus') ? 'selected' : '' ?>>Asus</option>
                                <option value="HP" <?= (isset($item) && $item['merk_laptop'] == 'HP') ? 'selected' : '' ?>>HP</option>
                                <option value="Lenovo" <?= (isset($item) && $item['merk_laptop'] == 'Lenovo') ? 'selected' : '' ?>>Lenovo</option>
                                <option value="Acer" <?= (isset($item) && $item['merk_laptop'] == 'Acer') ? 'selected' : '' ?>>Acer</option>
                            </select>
                        </div>

                        <!-- Tanggal Peminjaman -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Peminjaman Laptop *</label>
                            <input type="text" name="tgl_pinjam" class="form-control datepicker"
                                value="<?= isset($item['tgl_pinjam']) ? date('d/m/Y', strtotime($item['tgl_pinjam'])) : date('d/m/Y') ?>"
                                required>
                        </div>

                        <!-- Tanggal Rencana Pengembalian -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Rencana Pengembalian *</label>
                            <input type="text" name="rencana_kembali" class="form-control datepicker"
                                value="<?= isset($item['rencana_kembali']) ? date('d/m/Y', strtotime($item['rencana_kembali'])) : '' ?>"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Petugas yang Melayani Peminjaman *</label>
                            <input type="text" name="petugas_pinjam" class="form-control"
                                placeholder="Masukkan nama petugas"
                                value="<?= esc($item['petugas_pinjam'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Petugas yang Menerima Laptop</label>
                            <input type="text" name="petugas_kembali" class="form-control"
                                placeholder="Kosongkan jika belum dikembalikan"
                                value="<?= esc($item['petugas_kembali'] ?? '') ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Keperluan Peminjaman Laptop *</label>
                            <textarea name="keperluan" class="form-control"
                                placeholder="Jelaskan keperluan peminjaman laptop" required><?= esc($item['keperluan'] ?? '') ?></textarea>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengembalian Laptop</label>
                            <input type="text" name="tgl_kembali" class="form-control datepicker"
                                value="<?= isset($item['tgl_kembali']) ? date('d/m/Y', strtotime($item['tgl_kembali'])) : '' ?>">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><b>+</b> <?= isset($item) ? 'Update' : 'Tambah' ?> Peminjaman</button>
                        <button type="reset" class="btn btn-secondary">Reset Form</button>
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