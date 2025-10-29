<!-- app/Views/layout/header.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Peminjaman Laptop' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0d3879ff 0%, #2877ecff 50%, #7eabe0ff 100%);
            color: #fff;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #dbe4ff;
            font-size: 15px;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 8px;
            display: flex;
            align-items: center;
            transition: background 0.2s;
        }

        .sidebar .nav-link i {
            font-size: 18px;
            margin-right: 12px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #fff;
            color: #0d6efd;
            font-weight: 600;
        }

        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .content {
            flex-grow: 1;
            padding: 25px;
        }

        /* Tambahan biar sidebar fixed */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            /* sidebar sepanjang layar */
            overflow-y: auto;
        }

        .content {
            margin-left: 250px;
            /* kasih jarak biar konten nggak ketiban */
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-2">
            <div class="brand">
                <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="width:30px; height:30px; margin-right:10px; border-radius:6px;">
                PINJAMIN
            </div>

            <!-- <div class="brand">
                <i class="bi bi-laptop me-2"></i> PINJAMIN
            </div> -->
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(1) == '' ? 'active' : '' ?>" href="<?= site_url('/') ?>">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(1) == 'peminjaman' && service('uri')->getSegment(2) == '' ? 'active' : '' ?>" href="<?= site_url('peminjaman') ?>">
                        <i class="bi bi-folder2-open"></i> Data Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(1) == 'peminjaman' && service('uri')->getSegment(2) == 'create' ? 'active' : '' ?>" href="<?= site_url('peminjaman/create') ?>">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(1) == 'laptop' ? 'active' : '' ?>" href="<?= site_url('laptop') ?>">
                        <i class="bi bi-laptop"></i> Daftar Laptop
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(1) == 'pegawai' ? 'active' : '' ?>" href="<?= site_url('pegawai') ?>">
                        <i class="bi bi-people"></i> Daftar Pegawai
                    </a>
                </li>
            </ul>


            </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="content w-100">