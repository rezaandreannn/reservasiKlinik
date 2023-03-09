<?php

namespace Config;

use App\Controllers\Role;
use App\Controllers\User;
use App\Controllers\Dashboard;
use App\Controllers\Categories;
use App\Controllers\Permission;
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
$routes->get('/dashboard', 'Dashboard::index');




$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    // routes manage categories
    $routes->get('category', 'Categories::index');
    $routes->get('category/new', 'Categories::new');

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

// route master data
$routes->group('masterdata', ['filter' => 'role:admin'], function($routes) {
    // routes jadwal 
    $routes->get('jadwal', 'Jadwal::index');
    $routes->get('jadwal/baru', 'Jadwal::new');
    $routes->get('jadwal/ubah/(:num)', 'Jadwal::edit/$1');
    $routes->post('jadwal', 'Jadwal::create');
    $routes->put('jadwal/(:num)', 'Jadwal::update/$1');
    $routes->delete('jadwal/(:num)', 'Jadwal::delete/$1');

    // routes bank 
    $routes->get('bank', 'Bank::index');
    $routes->get('bank/baru', 'Bank::new');
    $routes->get('bank/ubah/(:num)', 'Bank::edit/$1');
    $routes->post('bank', 'Bank::create');
    $routes->put('bank/(:num)', 'Bank::update/$1');
    $routes->delete('bank/(:num)', 'Bank::delete/$1');
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