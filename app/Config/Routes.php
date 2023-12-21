<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



$routes->get('/', 'MainController::index');
$routes->get('/app', 'MainController::index');
$routes->get('/app/store', 'MainController::store');
$routes->get('/app/store/(:segment)', 'MainController::storeDetail/$1');
$routes->get('/app/scanmaster/(:segment)', 'MainController::scanMaster/$1');
$routes->get('/app/history/(:segment)', 'MainController::historyScan/$1');
$routes->get('/app/profile', 'MainController::getUserDetails');



$routes->get('/auth', 'AuthController::index');
