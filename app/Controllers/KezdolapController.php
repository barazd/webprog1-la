<?php

namespace App\Controllers;

use App\Controller;

/**
 * Kezdőlap controller-je
 */
class KezdolapController extends Controller
{
    public function index(): void
    {
        $this->view('kezdolap');
    }
}