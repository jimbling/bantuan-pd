<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Masuk::index');
$routes->post('masuk/auth', 'Masuk::auth');
$routes->get('masuk/keluar', 'Masuk::keluar');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/rekapitulasi', 'Rekap::index');
$routes->get('/bantuan/pip', 'Bantuan::index');
$routes->get('/pip/edit/(:num)', 'Bantuan::edit/$1');
$routes->post('/pip/update', 'Bantuan::update');
$routes->get('/bantuan/lainnya', 'DanaLainnya::index');
$routes->post('/siswapip/hapus/(:num)', 'Bantuan::hapus/$1');
$routes->post('/siswadanalain/hapus/(:num)', 'DanaLainnya::hapus/$1');
$routes->post('/siswapip/importData', 'Bantuan::importData');
$routes->get('/download', 'Bantuan::unduh');
$routes->post('/siswapip/ambilbank/(:num)', 'Bantuan::ambilbank/$1');
$routes->post('/danalain/ambilbank/(:num)', 'DanaLainnya::ambilDanaLainnya/$1');
$routes->get('/siswapip/surat_keterangan/(:num)', 'Bantuan::cetaksuketpip/$1');
$routes->post('siswapip/suket/hitung-cetak/(:num)', 'Bantuan::hitungCetak/$1');
$routes->get('/bantuan/pip/filterData', 'Bantuan::filterByYearTahapDana');
$routes->get('/bantuan/pip/getTahapsByYear/(:num)', 'Bantuan::getTahapsByYear/$1');
$routes->post('search', 'Dashboard::searchByNisn/$1');
$routes->post('/danalain/simpan', 'DanaLainnya::simpanDanaLain');
$routes->post('/danalain/update/(:num)', 'DanaLainnya::edit/$1');
$routes->get('danalain/get_detail/(:num)', 'DanaLainnya::get_detail/$1');
$routes->get('/setting', 'Akun::index');
$routes->get('/rekap', 'Rekap::index');
$routes->post('/setting-sp/update', 'Akun::updateData');
$routes->post('/upload/kopsurat', 'Akun::kopsurat');
$routes->post('/setting-akun/update', 'Akun::update');
$routes->get('/rekapitulasi/(:num)', 'Rekap::cetakRekap/$1');
$routes->get('/surat/suket_wali', 'Akun::cetakSuket');
$routes->get('/suket_wali/filterData', 'Bantuan::filterByYear');
$routes->post('/tabungan/hapus_buku_tabungan', 'Bantuan::hapus_buku_tabungan');

$routes->get('/siswapip/suket_aktivasi/(:num)', 'Bantuan::cetaksuketAktivasi/$1');
$routes->get('/siswapip/cetaksuketWali/(:num)', 'Bantuan::cetaksuketWali/$1');


$routes->post('/tabungan/unggah', 'Bantuan::upload_file_action');
$routes->get('pip/download_buku_tabungan/(:segment)', 'Bantuan::download_buku_tabungan/$1');



$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {
    $routes->post('bantuan/searchByNisn', 'BantuanAPI::searchByNisn');
});
$routes->get('search', 'Dashboard::ApisearchByNisn');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
