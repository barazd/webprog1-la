<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Session;

/**
 * Képek oldal controller-je
 */
class AuthController extends Controller
{  
    // A Belépés oldal
    public function index(): void
    {
        $this->view('belepes');
    }

    // Belépéskor
    public function login($data): void
    {
        $session = new Session();

        $errors = [];

        // Ha nincs bejelentkezett felhasználó
        if (!$session->current_user)
        {
            // Validáció
            if ($data['username'] && $data['password'])
            {
                if ($user = User::findBy('username', $data['username']))
                {
                    if ($user->verifyPassword($data['password']))
                    {
                        $session->current_user = $user->id;

                        // Kezdőlapra
                        header("Location: /");
                        die();
                    }
                    else
                    {
                        $errors[] = 'Hibás jelszó!';
                    }
                }
                else
                {
                    $errors[] = 'Nincs ilyen felhasználó!';
                }
            }
            else 
            {
                $errors[] = 'Kötelező megadni a felhazsnálónevet és a jelszót!';
            }
        }
        $this->view('belepes', ['errors' => $errors]);
    }

    public function logout(): void
    {

        $this->view('belepes', []);
    }

    public function register(): void
    {

        $this->view('belepes', []);
    }
}