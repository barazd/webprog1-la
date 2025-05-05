<?php

namespace App\Controllers;

use App\Controller;
use App\Router;

/**
 * Kezdőlap controller-je
 */
class KapcsolatController extends Controller
{
    // Kapcsolat oldal
    public function index(): void
    {
        $router = new Router();
        $this->view('kapcsolat', []);
    }

    // Üzenet mentése
    public function save(): void
    {
        $router = new Router();
        $this->view('kapcsolat', []);
    }

    // Üzenetek oldal
    public function admin_index(): void
    {
        $router = new Router();
        $this->view('uzenetek', []);
    }
}