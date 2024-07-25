<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('users', 'UserController::index');
$routes->get('users/newUser', 'UserController::new');
$routes->get('users/(:num)', 'UserController::show/$1');
$routes->post('users', 'UserController::create');
$routes->get('users/(:segment)/editUser', 'UserController::edit/$1');
$routes->put('users/(:segment)', 'UserController::update/$1');
$routes->delete('users/(:segment)', 'UserController::delete/$1');

//$routes->resource('users', ['placeholder' => '(:num)', 'except' => 'show']);