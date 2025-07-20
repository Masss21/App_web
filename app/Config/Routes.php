<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/login-process', 'Admin::loginProcess');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/logout', 'Admin::logout');

$routes->get('/admin/ajax/(:segment)', 'Admin::ajaxLoad/$1');

$routes->get('/admin/form-pelanggan', 'Admin::formPelanggan');
$routes->get('/admin/form-pelanggan/(:num)', 'Admin::formPelanggan/$1');
$routes->post('/admin/save-pelanggan', 'Admin::savePelanggan');
$routes->post('/admin/delete-pelanggan/(:num)', 'Admin::deletePelanggan/$1');


$routes->get('/admin/form-kendaraan', 'Admin::formKendaraan');
$routes->get('/admin/form-kendaraan/(:num)', 'Admin::formKendaraan/$1');
$routes->post('/admin/save-kendaraan', 'Admin::saveKendaraan');
$routes->post('/admin/delete-kendaraan/(:num)', 'Admin::deleteKendaraan/$1');


$routes->get('/admin/form-servis', 'Admin::formServis');
$routes->get('/admin/form-servis/(:num)', 'Admin::formServis/$1');
$routes->post('/admin/save-servis', 'Admin::saveServis');
$routes->post('/admin/delete-servis/(:num)', 'Admin::deleteServis/$1');

$routes->get('/admin/cetakNota/(:num)', 'Admin::cetakNota/$1');
$routes->get('/admin/cetakLaporan', 'Admin::cetakLaporan');

$routes->get('/admin/getAntrian/(:num)', 'Admin::getAntrian/$1');
$routes->post('/admin/updateStatusAntrian', 'Admin::updateStatusAntrian');

$routes->post('/admin/delete-pelanggan', 'Admin::deletePelanggan');
$routes->post('admin/updateStatusAntrian', 'Admin::updateStatusAntrian');
$routes->get('admin/proses-antrian/(:num)', 'Admin::prosesAntrian/$1');

$routes->get('/admin/cetak-nota/(:num)', 'Admin::cetakNota/$1');
$routes->get('/admin/cari-laporan', 'Admin::cariLaporan');

$routes->get('/', 'Pelanggan::home');
$routes->get('/pelanggan/antrian', 'Pelanggan::formAntrian');
$routes->post('/pelanggan/submit-antrian', 'Pelanggan::submitAntrian');
$routes->get('/admin/login',         'Admin::login');
$routes->post('/admin/login-process','Admin::loginProcess');
$routes->get('/admin/dashboard',     'Admin::dashboard');
$routes->post('/admin/delete-antrian', 'Admin::deleteAntrian');

$routes->get('/admin/getKategoriServis', 'Admin::getKategoriServis');

/**
 * @var RouteCollection $routes
 */

