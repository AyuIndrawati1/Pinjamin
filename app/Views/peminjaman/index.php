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
                    <th>Nama Laptop</th>
                    <th>Tgl Pinjam</th>
                    <th>Rencana Kembali</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc($item['nama_peminjam']) ?></td>
                            <td>
                                <?= esc($item['nama_laptop']) ?>
                                <?php if (!empty($item['seri'])): ?>
                                    (<?= esc($item['seri']) ?>)
                                <?php endif; ?>
                            </td>

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
                                    if (strtotime($item['tgl_kembali']) > strtotime($item['rencana_kembali'])) {
                                        $status = 'Dikembalikan Terlambat';
                                    } else {
                                        $status = 'Dikembalikan';
                                    }
                                } elseif (!empty($item['rencana_kembali']) && strtotime(date('Y-m-d')) > strtotime($item['rencana_kembali'])) {
                                    $status = 'Terlambat';
                                }

                                $badgeClass = match ($status) {
                                    'Dipinjam' => 'bg-primary',
                                    'Terlambat' => 'bg-danger',
                                    'Dikembalikan Terlambat' => 'bg-warning',
                                    default => 'bg-success'
                                };
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                            </td>

                            <!-- Aksi -->
                            <td class="d-flex gap-1 align-items-center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opsi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('peminjaman/show/' . $item['id']) ?>">
                                                <i class="bi bi-eye"></i> Lihat
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('peminjaman/edit/' . $item['id']) ?>">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('peminjaman/delete/' . $item['id']) ?>"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <?php if ($status == 'Dipinjam' || $status == 'Terlambat'): ?>
                                    <a href="<?= site_url('peminjaman/kembalikan/' . $item['id']) ?>"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Tandai sebagai sudah dikembalikan?')"
                                        title="Konfirmasi pengembalian">
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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$notifications = [];

foreach ($items as $item) {
    if ($item['rencana_kembali'] == date('Y-m-d') && empty($item['tgl_kembali'])) {
        $notifications[] = [
            'icon' => 'warning',
            'title' => '⚠️ Pengingat untuk ' . esc($item['nama_peminjam']),
            'text'  => 'Laptop "' . esc($item['merk_laptop']) . (!empty($item['seri']) ? ' ' . esc($item['seri']) : '') . '" harus dikembalikan hari ini.'
        ];
    } elseif (!empty($item['rencana_kembali']) && strtotime(date('Y-m-d')) > strtotime($item['rencana_kembali']) && empty($item['tgl_kembali'])) {
        $notifications[] = [
            'icon' => 'error',
            'title' => '⏰ Terlambat! ' . esc($item['nama_peminjam']),
            'text'  => 'Laptop "' . esc($item['merk_laptop']) . (!empty($item['seri']) ? ' ' . esc($item['seri']) : '') . '" belum dikembalikan dan sudah lewat batas waktu!'
        ];
    }
}
?>

<script>
    const notifications = <?= json_encode($notifications) ?>;

    async function showNotifications(notifications) {
        for (const notif of notifications) {
            await Swal.fire({
                toast: true,
                position: 'top-end',
                icon: notif.icon,
                title: notif.title,
                text: notif.text,
                showCloseButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Oke',
                timer: undefined,
            });
        }
    }

    if (notifications.length > 0) {
        showNotifications(notifications);
    }
</script>
