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
