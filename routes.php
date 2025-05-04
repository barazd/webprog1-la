<?php

/**
 * ÚTVONALAK
 */

use App\Controllers\AuthController;
use App\Controllers\KepekController;
use App\Controllers\KezdolapController;
use App\Router;

$router = new Router();

$router->get('/', KezdolapController::class, 'index');

$router->get('/kepek', KepekController::class, 'index');

$router->get('/belepes', AuthController::class, 'index');
$router->post('/belepes', AuthController::class, 'login');
$router->post('/regisztracio', AuthController::class, 'register');

$router->init();