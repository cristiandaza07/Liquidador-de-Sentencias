<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ---- INICIO ROUTES ----
$routes->get('/', 'UsuariosController::index');
$routes->post('/login', 'UsuariosController::login');
$routes->post('/verificarUsuario', 'UsuariosController::verificarUsuario');
$routes->get('/salir', 'UsuariosController::cerrarSesion');

// ---- LIQUIDACIONES ROUTES ----
$routes->group('liquidaciones', ['filter' => 'Session'], static function($routes){
    $routes->get('', 'Liquidaciones\LiquidacionesController::menuLiquidador');

    $routes->get('dtf', 'Liquidaciones\LiquidacionesController::liquidacionDtf');
    $routes->post('dtf/resultado', 'Liquidaciones\LiquidacionesController::resultadoDtf');
    $routes->post('dtf/resultado/guardar', 'Liquidaciones\LiquidacionesController::guardarLiquidacionDtf');
    $routes->post('dtf/resultado/pdf', 'Liquidaciones\LiquidacionesController::crearPdf');

    $routes->get('indexada', 'Liquidaciones\LiquidacionesController::liquidacionIndexada');    
    $routes->post('indexada/resultado', 'Liquidaciones\LiquidacionesController::resultadoIndexada');  
    $routes->post('indexada/resultado/guardar', 'Liquidaciones\LiquidacionesController::guardarLiquidacionIndexada');  
});

// ---- ADMINISTRADOR ROUTES ----
$routes->group('admin', ['namespace'=>'App\Controllers\Admin','filter' => 'Session'],function($routes){
    $routes->get('crearUsuario', 'AdminController::menuAdmin'); 
    $routes->post('crearUsuario/agregarUsuario', 'AdminController::agregarUsuario'); 

    $routes->get('crearDtf', 'AdminController::crearNuevoDtf'); 
    $routes->post('crearDtf/agregarDtf', 'AdminController::agregarDtf'); 

    $routes->get('crearIpc', 'AdminController::crearNuevoIpc'); 

    $routes->post('crearUsuario/usuarioExiste', 'AdminController::usuarioExiste'); 
});






//$routes->get('/liquidaciones/pdf', 'LiquidacionesController::nueva');
