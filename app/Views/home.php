<?= $this->include('layout/header') ?>

<div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center"
    style="background: url('<?= base_url('img/bps.jpeg') ?>') no-repeat center center fixed; background-size: cover;">

    <div class="container mt-4 bg-white bg-opacity-75 p-5 rounded shadow">
        <h2 class="mb-4 text-center">Selamat Datang di <b>PINJAMIN</b></h2>
        <p class="text-muted text-center">Sistem Peminjaman Laptop BPS Kabupaten Malang</p>

        <div class="row g-4 mt-3">
            <!-- Card Dipinjam -->
            <div class="col-md-4">
                <div class="card shadow border-0 bg-primary text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sedang Dipinjam</h5>
                        <h3 class="fw-bold"><?= $dipinjam ?></h3>
                        <p>Laptop</p>
                    </div>
                </div>
            </div>

            <!-- Stok Perangkat
            <div class="col-md-4">
                <div class="card shadow border-0 bg-primary text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Stok Perangkat</h5>
                        <h3 class="fw-bold"><?= $dipinjam ?></h3>
                        <p>Laptop</p>
                    </div>
                </div>
            </div> -->


            <!-- Card Dikembalikan -->
            <div class="col-md-4">
                <div class="card shadow border-0 bg-success text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sudah Dikembalikan</h5>
                        <h3 class="fw-bold"><?= $dikembalikan ?></h3>
                        <p>Laptop</p>
                    </div>
                </div>
            </div>

            <!-- Card Terlambat -->
            <div class="col-md-4">
                <div class="card shadow border-0 bg-danger text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Terlambat</h5>
                        <h3 class="fw-bold"><?= $terlambat ?></h3>
                        <p>Laptop</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>