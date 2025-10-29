<?= $this->include('layout/header') ?>

<div class="container">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <!-- Judul -->
            <h4 class="mb-4"><span class="text-primary">+</span> Form Laptop</h4>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="formTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pinjam-tab" data-bs-toggle="tab" data-bs-target="#pinjam" type="button" role="tab">
                        Peminjaman
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kembali-tab" data-bs-toggle="tab" data-bs-target="#kembali" type="button" role="tab">
                        Pengembalian
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="formTabContent">
                <!-- ================= FORM PEMINJAMAN ================= -->
                <div class="tab-pane fade show active" id="pinjam" role="tabpanel">
                    <form method="post" action="<?= isset($item) ? site_url('peminjaman/update/' . $item['id']) : site_url('peminjaman/store') ?>">
                        <div class="row g-3">
                            <!-- Nama Peminjam -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Nama Peminjam *</label>
                                <select name="nama_peminjam" class="form-select" required>
                                    <option value="">Pilih nama peminjam</option>
                                    <?php if (!empty($pegawaiList)) : ?>
                                        <?php foreach ($pegawaiList as $pegawai) : ?>
                                            <option value="<?= esc($pegawai['nama']) ?>"
                                                <?= (isset($item) && $item['nama_peminjam'] == $pegawai['nama']) ? 'selected' : '' ?>>
                                                <?= esc($pegawai['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Merk Laptop -->
                            <div class="col-md-6">
                                <label for="laptop_id" class="form-label fw-semibold">Laptop *</label>
                                <select name="laptop_id" id="laptop_id" class="form-select" required>
                                    <option value="">Pilih laptop</option>
                                    <?php if (!empty($laptopList)) : ?>
                                        <?php foreach ($laptopList as $laptop) : ?>
                                            <option value="<?= esc($laptop['id']) ?>"
                                                <?= (isset($item) && $item['laptop_id'] == $laptop['id']) ? 'selected' : '' ?>>
                                                <?= esc($laptop['nama_laptop']) ?> (<?= esc($laptop['seri']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Tidak ada laptop tersedia</option>
                                    <?php endif; ?>
                                </select>
                            </div>


                            <!-- Petugas Peminjaman -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Petugas Peminjaman *</label>
                                <select name="petugas_pinjam" class="form-select" required>
                                    <option value="">Pilih Petugas</option>
                                    <?php 
                                        $petugasList = [
                                            "Rony Hadiyanto, SST",
                                            "Akhmad Khoirul Hadi, SE",
                                            "Lukman Azhari, SST"
                                        ];
                                        foreach ($petugasList as $petugas) : ?>
                                            <option value="<?= esc($petugas) ?>"
                                                <?= (isset($item) && $item['petugas_pinjam'] == $petugas) ? 'selected' : '' ?>>
                                                <?= esc($petugas) ?>
                                            </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Peminjaman *</label>
                                <input type="text" name="tgl_pinjam" class="form-control datepicker tanggal-input"
                                    value="<?= isset($item['tgl_pinjam']) ? date('d/m/Y', strtotime($item['tgl_pinjam'])) : date('d/m/Y') ?>"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Rencana Pengembalian *</label>
                                <input type="text" name="rencana_kembali" class="form-control datepicker"
                                    value="<?= isset($item['rencana_kembali']) ? date('d/m/Y', strtotime($item['rencana_kembali'])) : '' ?>"
                                    required>
                            </div>

                            <!-- Keperluan -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Keperluan *</label>
                                <textarea name="keperluan" class="form-control" rows="3" required><?= esc($item['keperluan'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn text-white px-4 py-2 rounded-3"
                                style="background: linear-gradient(135deg, #4facfe, #007bff); border: none;">
                                <b>+</b> <?= isset($item) ? 'Update' : 'Tambah' ?> Peminjaman
                            </button>
                            <button type="reset" class="btn btn-secondary px-4 py-2 rounded-3">Reset</button>
                        </div>
                    </form>
                </div>

                <!-- ================= FORM PENGEMBALIAN ================= -->
                <div class="tab-pane fade" id="kembali" role="tabpanel">
                    <form method="post" action="<?= site_url('pengembalian/store') ?>">
                        <div class="row g-3">
                            <!-- Nama Peminjam -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Nama Peminjam *</label>
                                <select name="nama_peminjam" class="form-select" required>
                                    <option value="">Pilih nama peminjam</option>
                                    <?php if (!empty($pegawaiList)) : ?>
                                        <?php foreach ($pegawaiList as $pegawai) : ?>
                                            <option value="<?= esc($pegawai['nama']) ?>"><?= esc($pegawai['nama']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Tanggal & Petugas -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Pengembalian *</label>
                                <input type="text" name="tgl_kembali" class="form-control datepicker" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Petugas Pengembalian *</label>
                                <select name="petugas_kembali" class="form-select" required>
                                    <option value="">Pilih Petugas</option>
                                    <?php foreach ($petugasList as $petugas) : ?>
                                        <option value="<?= esc($petugas) ?>"><?= esc($petugas) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn text-white px-4 py-2 rounded-3"
                                style="background: linear-gradient(135deg, #4facfe, #007bff); border: none;">
                                <b>✓</b> Simpan Pengembalian
                            </button>
                            <button type="reset" class="btn btn-secondary px-4 py-2 rounded-3">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JQuery & Datepicker -->
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

<?= $this->include('layout/footer') ?>
