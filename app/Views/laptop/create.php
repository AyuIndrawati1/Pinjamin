<?= $this->include('layout/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4 text-center fw-bold text-primary">
                        Tambah Data Laptop
                    </h2>

                    <form method="post" action="<?= site_url('laptop/store') ?>">
                        <div class="mb-3">
                            <label class="form-label">Nama Laptop</label>
                            <input type="text" name="nama_laptop" class="form-control rounded-3 shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seri</label>
                            <input type="text" name="seri" class="form-control rounded-3 shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Pengadaan</label>
                            <input type="date" name="tahun_pengadaan" class="form-control rounded-3 shadow-sm" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= site_url('laptop') ?>" 
                               class="btn btn-secondary px-4 py-2 rounded-3">
                                Kembali
                            </a>
                            <button type="submit" 
                                class="btn text-white px-4 py-2 rounded-3"
                                style="background: linear-gradient(135deg, #4facfe, #007bff); border: none;">
                                <b>+</b> Simpan Laptop
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
