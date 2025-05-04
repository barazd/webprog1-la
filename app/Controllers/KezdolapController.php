<?php

namespace App\Controllers;

use App\Controller;
use App\Router;

/**
 * Kezdőlap controller-je
 */
class KezdolapController extends Controller
{
    public function index(): void
    {
        $router = new Router();
        $this->view('kezdolap', []);
    }
}