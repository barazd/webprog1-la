<?php

/**
 * ÚTVONALAK
 */

use App\Controllers\KepekController;
use App\Controllers\KezdolapController;
use App\Router;

$router = new Router();

$router->get('/', KezdolapController::class, 'index');

$router->get('/kepek', KepekController::class, 'index');

$router->init();