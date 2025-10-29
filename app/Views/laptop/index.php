<?= $this->include('layout/header') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary">Daftar Laptop</h3>
        <a href="<?= site_url('laptop/create') ?>" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Laptop
        </a>
    </div>

    <div class="bg-white p-4 rounded-3 shadow-sm">
        <table class="table table-bordered table-striped table-hover text-center w-100 align-middle">
            <thead class="table-primary">
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 25%;">Nama Laptop</th>
                    <th style="width: 25%;">Seri</th>
                    <th style="width: 20%;">Tahun Pengadaan</th>
                    <th style="width: 25%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($laptops)): ?>
                    <?php foreach ($laptops as $index => $laptop): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td class="text-capitalize"><?= esc($laptop['nama_laptop']); ?></td>
                            <td><?= esc($laptop['seri']); ?></td>
                            <td>
                                <?= !empty($laptop['tahun_pengadaan']) && $laptop['tahun_pengadaan'] != '0000-00-00' 
                                    ? esc($laptop['tahun_pengadaan']) 
                                    : '<span class="text-muted">Belum diisi</span>' ?>
                            </td>
                            <td>
                                <a href="<?= site_url('laptop/edit/' . $laptop['id']); ?>" 
                                   class="btn btn-sm btn-warning me-1">
                                    ✏ Edit
                                </a>
                                <a href="<?= site_url('laptop/delete/' . $laptop['id']); ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus laptop ini?')">
                                    🗑 Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data laptop</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('layout/footer') ?>
