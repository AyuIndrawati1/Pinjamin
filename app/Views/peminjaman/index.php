<!-- app/Views/peminjaman/index.php -->
<?= $this->include('layout/header') ?>

<h2 class="mb-4">Daftar Peminjaman</h2>

<!-- search & Excel -->
<div class="d-flex align-items-center mb-4 gap-3">
    <!-- Form Search -->
    <form action="<?= site_url('peminjaman/search') ?>" method="get" class="flex-grow-1" style="max-width:400px;">
        <div class="position-relative">
            <!-- Input oval -->
            <input
                type="text"
                name="keyword"
                class="form-control rounded-pill ps-3 pe-5"
                placeholder="search"
                value="<?= $keyword ?? '' ?>">

            <!-- Tombol kecil bulat di kanan -->
            <button type="submit"
                class="btn btn-primary btn-sm rounded-circle position-absolute d-flex align-items-center justify-content-center"
                style="right:8px; top:50%; transform:translateY(-50%); width:32px; height:32px;">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
    <!-- Tombol Unduh Excel -->
    <a href="<?= site_url('peminjaman/exportExcel') ?>" class="btn btn-success d-flex align-items-center">
        <i class="bi bi-file-earmark-excel me-2"></i> Unduh Riwayat Excel
    </a>
</div>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Merk Laptop</th>
                    <th>Tgl Pinjam</th>
                    <th>Rencana Kembali</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc($item['nama_peminjam']) ?></td>
                            <td><?= esc($item['merk_laptop']) ?></td>

                            <!-- Format tanggal -->
                            <td>
                                <?= (!empty($item['tgl_pinjam']) && $item['tgl_pinjam'] != '0000-00-00')
                                    ? date('d/m/Y', strtotime($item['tgl_pinjam'])) : '-' ?>
                            </td>
                            <td>
                                <?= (!empty($item['rencana_kembali']) && $item['rencana_kembali'] != '0000-00-00')
                                    ? date('d/m/Y', strtotime($item['rencana_kembali'])) : '-' ?>
                            </td>
                            <td>
                                <?= (!empty($item['tgl_kembali']) && $item['tgl_kembali'] != '0000-00-00')
                                    ? date('d/m/Y', strtotime($item['tgl_kembali'])) : '-' ?>
                            </td>

                            <!-- Status otomatis -->
                            <td>
                                <?php
                                $status = 'Dipinjam';
                                if (!empty($item['tgl_kembali']) && $item['tgl_kembali'] != '0000-00-00') {
                                    $status = 'Dikembalikan';
                                } elseif (!empty($item['rencana_kembali']) && strtotime(date('Y-m-d')) > strtotime($item['rencana_kembali'])) {
                                    $status = 'Terlambat';
                                }
                                $badgeClass = $status == 'Dipinjam' ? 'bg-primary' : ($status == 'Terlambat' ? 'bg-danger' : 'bg-success');
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                            </td>

                            <!-- Aksi -->
                            <td>
                                <a href="<?= site_url('peminjaman/show/' . $item['id']) ?>" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= site_url('peminjaman/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= site_url('peminjaman/delete/' . $item['id']) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>

                                <!-- Tombol Kembalikan hanya jika belum dikembalikan -->
                                <?php if ($status == 'Dipinjam' || $status == 'Terlambat'): ?>
                                    <a href="<?= site_url('peminjaman/kembalikan/' . $item['id']) ?>"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Tandai sebagai sudah dikembalikan?')">
                                        <i class="bi bi-check"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data peminjaman</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('layout/footer') ?>