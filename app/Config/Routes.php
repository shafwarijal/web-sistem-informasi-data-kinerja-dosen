<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->post('/', 'Auth::login');
$routes->get('/dosen-jquery', 'Dosen::index');
$routes->get('/dosen-jquery/get_dosen', 'Dosen::get_dosen');
$routes->get('/dosen-jquery/get_add_dosen', 'Dosen::get_add_dosen');
$routes->get('getAlldosen', 'Dosen::getAlldosen', ['as' => 'get.all.dosen']);
$routes->get('getAllpenelitian', 'Penelitian::getAllpenelitian', ['as' => 'get.all.penelitian']);
$routes->get('getAllpemakalah', 'Pemakalah::getAllpemakalah', ['as' => 'get.all.pemakalah']);
$routes->get('getAlljurnal', 'Jurnal::getAlljurnal', ['as' => 'get.all.jurnal']);
$routes->get('getAllhki', 'Hki::getAllhki', ['as' => 'get.all.hki']);
$routes->get('getAllbukuajar', 'Buku_Ajar::getAllbukuajar', ['as' => 'get.all.bukuajar']);
$routes->get('getAllakunadmin', 'Akunadmin::getAllakunadmin', ['as' => 'get.all.akunadmin']);
$routes->get('/penelitian/get_Dosen', 'Penelitian::get_Dosen');
$routes->post('/penelitian/getDosenAgt', 'Penelitian::getDosenAgt');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
