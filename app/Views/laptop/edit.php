<?= $this->include('layout/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <!-- Header -->
                <div class="card-header text-center text-white rounded-top-4"
                     style="background: linear-gradient(135deg, #4facfe, #007bff);">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-laptop"></i> Edit Data Laptop
                    </h4>
                    <small class="text-light">Perbarui data perangkat dengan benar</small>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <form method="post" action="<?= site_url('laptop/update/' . $laptop['id']) ?>">
                        
                        <!-- Nama Laptop -->
                        <div class="mb-4">
                            <label for="nama_laptop" class="form-label fw-semibold">Nama Laptop</label>
                            <input type="text" class="form-control form-control-lg rounded-3 shadow-sm" 
                                   id="nama_laptop" name="nama_laptop" 
                                   value="<?= esc($laptop['nama_laptop']) ?>" 
                                   placeholder="contoh: Asus, Acer, HP" required>
                        </div>

                        <!-- Seri -->
                        <div class="mb-4">
                            <label for="seri" class="form-label fw-semibold">Seri</label>
                            <input type="text" class="form-control form-control-lg rounded-3 shadow-sm text-uppercase" 
                                   id="seri" name="seri" 
                                   value="<?= esc($laptop['seri']) ?>" 
                                   placeholder="contoh: A123XYZ" required>
                        </div>

                        <!-- Tahun Pengadaan -->
                        <div class="mb-4">
                            <label for="tahun_pengadaan" class="form-label fw-semibold">Tahun Pengadaan</label>
                            <input type="date" class="form-control form-control-lg rounded-3 shadow-sm" 
                                   id="tahun_pengadaan" name="tahun_pengadaan" 
                                   value="<?= esc($laptop['tahun_pengadaan']) ?>" required>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= site_url('laptop') ?>" 
                               class="btn btn-secondary px-4 py-2 rounded-3">
                                <i class="bi bi-arrow-left-circle"></i> Batal
                            </a>
                            <button type="submit" 
                                    class="btn text-white px-4 py-2 rounded-3"
                                    style="background: linear-gradient(135deg, #4facfe, #007bff); border: none;">
                                <i class="bi bi-check-circle"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
