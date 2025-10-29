<?= $this->include('layout/header') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-primary">Daftar Pegawai</h3>
    <a href="<?= site_url('pegawai/create') ?>" class="btn btn-primary shadow-sm">
        + Tambah Pegawai
    </a>
</div>

<div class="card shadow-sm rounded-3 border-0">
    <div class="card-body">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nama Pegawai</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if (!empty($pegawai)): ?>
                    <?php foreach ($pegawai as $row): ?>
                        <tr>
                            <td><?= esc($row['id']) ?></td>
                            <td class="text-start"><?= esc($row['nama']) ?></td>
                            <td>
                                <a href="<?= site_url('pegawai/edit/' . $row['id']) ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= site_url('pegawai/delete/' . $row['id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data pegawai</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('layout/footer') ?>
