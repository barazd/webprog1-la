<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Router;

/**
 * Képek oldal controller-je
 */
class KepekController extends Controller
{
    public function index(): void
    {
        
        $router = new Router();
        $this->view('kepek', []);
    }
}