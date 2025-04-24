<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Usuario::inicio');
$routes->post('login', 'Usuario::login');



$routes->get('index', 'Usuario::index');
$routes->post('registro', 'Usuario::registroU');
$routes->post('updateU', 'Usuario::updateU');
$routes->post('actualizarU', 'Usuario::actualizarU');
$routes->post('eliminarU', 'Usuario::eliminarU');

$routes->get('ventasUsuarioCategoria/(:num)', 'Usuario::ventasUsuarioCategoria/$1');
$routes->get('ventasDiariasCategoria/(:num)', 'Usuario::ventasDiariasCategoria/$1');
$routes->get('rankingVentasTotalesUsuario/(:num)', 'Usuario::rankingVentasTotalesUsuario/$1');
$routes->get('mejoresProductosVendidos/(:num)', 'Usuario::mejoresProductosVendidos/$1');

$routes->get('menoresProductosVendidos/(:num)', 'Usuario::menoresProductosVendidos/$1');

$routes->get('logout', 'Usuario::logout');
