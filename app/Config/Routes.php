<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index'); // halaman utama (dashboard)
$routes->get('/peminjaman', 'Peminjaman::index'); // halaman data peminjaman

// Routes untuk Peminjaman
$routes->get('peminjaman/create', 'Peminjaman::create');   // form tambah
$routes->post('peminjaman/store', 'Peminjaman::store');    // simpan data baru
$routes->get('peminjaman/(:num)', 'Peminjaman::show/$1');  // detail
$routes->get('peminjaman/edit/(:num)', 'Peminjaman::edit/$1'); // form edit
$routes->post('peminjaman/update/(:num)', 'Peminjaman::update/$1'); // simpan edit
$routes->get('peminjaman/delete/(:num)', 'Peminjaman::delete/$1');  // hapus
$routes->get('peminjaman/show/(:num)', 'Peminjaman::show/$1');
//tombol ✔
$routes->get('peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1');

// unduh data
$routes->get('/', 'Home::index');
// $routes->get('peminjaman/export', 'Peminjaman::exportCsv');

$routes->get('peminjaman/exportExcel', 'Peminjaman::exportExcel');
$routes->get('peminjaman/show_pdf/(:num)', 'Peminjaman::show_pdf/$1');
$routes->get('peminjaman/search', 'Peminjaman::search');
$routes->get('peminjaman/cetak/(:num)', 'Peminjaman::cetak/$1');
$routes->get('laptop', 'Laptop::index');
$routes->get('laptop/create', 'Laptop::create');
$routes->post('laptop/store', 'Laptop::store');
$routes->get('laptop/edit/(:num)', 'Laptop::edit/$1');
$routes->post('laptop/update/(:num)', 'Laptop::update/$1');
$routes->get('laptop/delete/(:num)', 'Laptop::delete/$1');

$routes->group('pegawai', function ($routes) {
    $routes->get('/', 'Pegawai::index');
    $routes->get('create', 'Pegawai::create');
    $routes->post('store', 'Pegawai::store');
    $routes->get('edit/(:num)', 'Pegawai::edit/$1');
    $routes->post('update/(:num)', 'Pegawai::update/$1');
    $routes->get('delete/(:num)', 'Pegawai::delete/$1');

    // role untuk peminjaman/pengembalian
    $routes->get('jadikanPeminjaman/(:num)', 'Pegawai::jadikanPeminjaman/$1');
    $routes->get('jadikanPengembalian/(:num)', 'Pegawai::jadikanPengembalian/$1');
    $routes->get('jadikanPegawai/(:num)', 'Pegawai::jadikanPegawai/$1');
});

