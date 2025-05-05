<?php

/**
 * ÚTVONALAK
 */

use App\Controllers\AuthController;
use App\Controllers\KapcsolatController;
use App\Controllers\KepekController;
use App\Controllers\KezdolapController;
use App\Router;

$router = new Router();

$router->get('/', KezdolapController::class, 'index');

$router->get('/kepek', KepekController::class, 'index');

$router->get('/kapcsolat', KapcsolatController::class, 'index');
$router->post('/kapcsolat', KapcsolatController::class, 'save');
$router->get('/uzenetek', KapcsolatController::class, 'admin_index');

$router->get('/belepes', AuthController::class, 'index');
$router->post('/belepes', AuthController::class, 'login');
$router->post('/regisztracio', AuthController::class, 'register');
$router->get('/kilepes', AuthController::class, 'logout');

$router->init();