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

$routes->get('/', 'Home::index');
$routes->group('login', function($routes){
	$routes->get('view', 'Login::index');
	$routes->add('cek_login', 'Login::cek_login');
	$routes->get('logout', 'Login::logout');
});

$routes->group('alternatif', function($routes){
	$routes->get('view', 'Alternatif::index');
	$routes->add('add', 'Alternatif::add');
	$routes->get('view_edit/(:any)', 'Alternatif::view_edit/$1');
	$routes->add('update/(:any)', 'Alternatif::update/$1');
	$routes->get('delete/(:any)', 'Alternatif::delete/$1');
});

$routes->group('kriteria', function($routes){
	$routes->get('view', 'Kriteria::index');
	$routes->add('add', 'Kriteria::add');
	$routes->get('view_edit/(:any)', 'Kriteria::view_edit/$1');
	$routes->add('update/(:any)', 'Kriteria::update/$1');
	$routes->get('delete/(:any)', 'Kriteria::delete/$1');
});

$routes->group('rel_alternatif', function($routes){
	$routes->get('view', 'Rel_alternatif::index');
	$routes->add('update/(:any)', 'Rel_alternatif::update/$1');
});

$routes->group('rel_kriteria', function($routes){
	$routes->get('view', 'Rel_kriteria::index');
	$routes->add('update', 'Rel_kriteria::update/$1');
});

$routes->group('hitung', function($routes){
	$routes->get('view', 'Hitung::index');
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
