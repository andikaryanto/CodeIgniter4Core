<?php namespace Config;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->add('login', 'Login::index');
$routes->add('login/dologin', 'Login::dologin');
$routes->get('home', 'Home::index');

$routes->get('mgroupuser', 'M_groupuser::index');
$routes->get('mgroupuser/add', 'M_groupuser::add');
$routes->add('mgroupuser/addsave', 'M_groupuser::addsave');
$routes->get('mgroupuser/edit/(:any)', 'M_groupuser::edit/$1');
$routes->add('mgroupuser/editsave', 'M_groupuser::editsave');
$routes->add('mgroupuser/delete', 'M_groupuser::delete');
$routes->add('mgroupuser/roles/(:any)', 'M_groupuser::roles/$1');
$routes->add('mgroupuser/saverole', 'M_groupuser::saverole');


$routes->get('muser', 'M_user::index');
$routes->get('muser/add', 'M_user::add');
$routes->add('muser/addsave', 'M_user::addsave');
$routes->get('muser/edit/(:any)', 'M_user::edit/$1');
$routes->add('muser/editsave', 'M_user::editsave');
$routes->add('muser/delete', 'M_user::delete');
$routes->add('muser/activate/(:num)', 'M_user::activate/$1');
$routes->get('changePassword', 'M_user::changePassword');
$routes->add('saveNewPassword', 'M_user::saveNewPassword');
$routes->get('settings', 'M_user::setting');
$routes->add('savesettings', 'M_user::savesetting');
$routes->add('saveprofile', 'M_user::saveprofile');
$routes->get('profile', 'M_user::profile');

$routes->get('mcompany', 'M_company::index');
$routes->add('mcompany/addsave', 'M_company::addsave');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
