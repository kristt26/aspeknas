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
$routes->get('/', 'Auth::index');
$routes->get('register', 'Auth::register');
$routes->post('daftar', 'Auth::daftar');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->group('home', function ($routes) {
    $routes->get('/', 'Admin\Home::index');
    $routes->get('token', 'Admin\Home::token');
    $routes->post('finish', 'Admin\Home::finish');
});
$routes->group('pembayaran', ['filter' => 'pend'], function ($routes) {
    $routes->get('/', 'Pembayaran::index');
    $routes->post('token', 'Pembayaran::token');
    $routes->post('post', 'Pembayaran::post');
});

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->group('klasifikasi', function ($routes) {
        $routes->get('/', 'Admin\Klasifikasi::index');
        $routes->get('read', 'Admin\Klasifikasi::read');
        $routes->post('post', 'Admin\Klasifikasi::post');
        $routes->put('put', 'Admin\Klasifikasi::put');
        $routes->delete('delete/(:any)', 'Admin\Klasifikasi::delete/$1');
    });
    $routes->group('sub_klasifikasi', function ($routes) {
        $routes->get('data/(:any)', 'Admin\SubKlasifikasi::index/$1');
        $routes->get('read/(:any)', 'Admin\SubKlasifikasi::read/$1');
        $routes->post('post', 'Admin\SubKlasifikasi::post');
        $routes->put('put', 'Admin\SubKlasifikasi::put');
        $routes->delete('delete/(:any)', 'Admin\SubKlasifikasi::delete/$1');
    });
    $routes->group('pengajuan', function ($routes) {
        $routes->get('/', 'Admin\Pengajuan::index');
        $routes->get('read', 'Admin\Pengajuan::read');
        $routes->post('post', 'Admin\Pengajuan::post');
        $routes->put('put', 'Admin\Pengajuan::put');
        $routes->delete('delete/(:any)', 'Admin\Pengajuan::delete/$1');
        $routes->get('berkas/(:any)', 'Admin\Pengajuan::berkas/$1');
        $routes->get('data_berkas/(:any)', 'Admin\Pengajuan::data_berkas/$1');
    });
    $routes->group('manajemen_user', function ($routes) {
        $routes->get('/', 'Admin\User::index');
        $routes->get('read', 'Admin\User::read');
        $routes->post('post', 'Admin\User::post');
        $routes->put('put', 'Admin\User::put');
        $routes->delete('delete/(:any)', 'Admin\User::delete/$1');
    });
});


$routes->group('pengajuan', ['filter' => 'pend'], function ($routes) {
    $routes->get('/', 'Pengajuan::index');
    $routes->get('add', 'Pengajuan::tambah');
    $routes->get('read', 'Pengajuan::read');
    $routes->get('get', 'Pengajuan::get');
    $routes->post('post', 'Pengajuan::post');
    $routes->put('put', 'Pengajuan::put');
    $routes->delete('deleted/(:any)', 'Pengajuan::delete/$1');
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
