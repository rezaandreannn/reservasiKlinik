<?php

namespace Config;

use App\Controllers\Role;
use App\Controllers\User;
use App\Controllers\Dashboard;
use App\Controllers\Categories;
use App\Controllers\Permission;
use App\Controllers\UserReservasi;
use App\Controllers\RoleHasPermission;

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
$routes->get('/', 'Home::index');
$routes->get('/treatment', 'Frond\Treatment::index');

$routes->get('/reservasi/(:num)', 'Frond\Reservasi::index/$1');
$routes->post('/reservasi', 'Frond\Reservasi::create');
$routes->put('/reservasi/batal/(:num)', 'Frond\Reservasi::batalReservasi/$1');

$routes->get('/reservasi-saya', 'Frond\Reservasi::getAuth');
$routes->get('/histori', 'Frond\Reservasi::getAuthHistori');
$routes->get('/histori-cetak', 'Frond\Reservasi::cetakAuthHistori');

$routes->post('/jadwal/cek_jadwal', 'Frond\Reservasi::validasiWaktu');
$routes->post('/jadwal/get_data_reservasi', 'Frond\Reservasi::getReservasiByTanggal');
$routes->post('/ambil_durasi', 'Frond\Reservasi::ambilDurasi');

$routes->get('/dashboard', 'Dashboard::index',  ['filter' => 'role:admin']);







$routes->group('admin', ['filter' => 'role:admin'], function($routes) {

    // routes manage user
    $routes->get('pengguna', 'User::index');
    $routes->get('pengguna/restore/(:num)', 'User::restore/$1');
    $routes->get('pengguna/show/(:num)', 'User::show/$1');
    $routes->get('pengguna/edit/(:num)', 'User::edit/$1');
    $routes->post('manage_role', 'User::manageRole');
    $routes->delete('pengguna/(:num)', 'User::delete/$1');
    $routes->delete('pengguna/force/(:num)', 'User::forceDelete/$1');
  
    // routes manage role
    $routes->get('grup', 'Role::index');
    $routes->get('grup/baru', 'Role::new');
    $routes->post('grup', 'Role::create');
    $routes->get('grup/(:num)', 'Role::edit/$1');
    $routes->put('grup/(:num)', 'Role::update/$1');
    $routes->delete('grup/(:num)', 'Role::delete/$1');

    // routes manage permission
    $routes->get('perizinan', 'Permission::index');
    $routes->get('perizinan/baru', 'Permission::new');
    $routes->post('perizinan', 'Permission::create');
    $routes->get('perizinan/(:num)', 'Permission::edit/$1');
    $routes->put('perizinan/(:num)', 'Permission::update/$1');
    $routes->delete('perizinan/(:num)', 'Permission::delete/$1');

    // routes role has permission
    $routes->get('perizinan-grup', 'RoleHasPermission::index');
    $routes->get('perizinan-grup/(:num)', 'RoleHasPermission::show/$1');
    $routes->post('changepermission', 'RoleHasPermission::changePermission');

    
});
        $routes->group('reservasi', ['filter' => 'role:admin'], function($routes) {
    
        $routes->get('bayar-offline', 'UserReservasi::getBayarOffline');
        $routes->put('bayar-offline/(:num)', 'UserReservasi::updateBayarOffline/$1');
        $routes->get('bayar-online', 'UserReservasi::getBayarOnline');
        $routes->delete('delete/(:num)', 'UserReservasi::delete/$1');
        });

// route master data
$routes->group('masterdata', ['filter' => 'role:admin'], function($routes) {
    // routes jadwal 
    $routes->get('jadwal', 'Jadwal::index');
    $routes->get('jadwal/baru', 'Jadwal::new');
    $routes->get('jadwal/ubah/(:num)', 'Jadwal::edit/$1');
    $routes->post('jadwal', 'Jadwal::create');
    $routes->put('jadwal/(:num)', 'Jadwal::update/$1');
    $routes->delete('jadwal/(:num)', 'Jadwal::delete/$1');

    // routes kategori 
    $routes->get('kategori', 'Kategori::index');
    $routes->get('kategori/baru', 'Kategori::new');
    $routes->get('kategori/ubah/(:num)', 'Kategori::edit/$1');
    $routes->post('kategori', 'Kategori::create');
    $routes->put('kategori/(:num)', 'Kategori::update/$1');
    $routes->delete('kategori/(:num)', 'Kategori::delete/$1');

    // routes bank 
    $routes->get('bank', 'Bank::index');
    $routes->get('bank/baru', 'Bank::new');
    $routes->get('bank/ubah/(:num)', 'Bank::edit/$1');
    $routes->post('bank', 'Bank::create');
    $routes->put('bank/(:num)', 'Bank::update/$1');
    $routes->delete('bank/(:num)', 'Bank::delete/$1');

    // routes treatment 
    $routes->get('treatment', 'Treatment::index');
    $routes->get('treatment/baru', 'Treatment::new');
    $routes->get('treatment/ubah/(:num)', 'Treatment::edit/$1');
    $routes->post('treatment', 'Treatment::create');
    $routes->put('treatment/(:num)', 'Treatment::update/$1');
    $routes->delete('treatment/(:num)', 'Treatment::delete/$1');
});

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