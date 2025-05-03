<?php

/**
 * ÚTVONALAK
 */

 use App\Controllers\KezdolapController;
 use App\Router;

 $router = new Router();

 $router->get('/', KezdolapController::class, 'index');