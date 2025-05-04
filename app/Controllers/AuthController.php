<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Session;

/**
 * Belpés és regisztráció oldal controller-je
 */
class AuthController extends Controller
{  
    // A Belépés oldal
    public function index(): void
    {
        if (Session::isAuthenticated())
        {
            header("Location: /");
            die();
        }
        $this->view('belepes');
    }

    // Belépéskor
    public function login($data): void
    {
        $errors = [];

        // Ha nincs bejelentkezett felhasználó
        if (!Session::isAuthenticated())
        {
            // Validáció
            if ($data['username'] && $data['password'])
            {
                if ($user = User::findBy('username', $data['username']))
                {
                    if ($user->verifyPassword($data['password']))
                    {
                        Session::set('authenticated_user_id', $user->id);

                        // Ha sikerült belépni, a kezdőlapra irányítjuk
                        header("Location: /");
                        die();
                    }
                    else
                    {
                        $errors[] = 'Sikertelen belépés, hibás jelszó!';
                    }
                }
                else
                {
                    $errors[] = 'Sikertelen belépés, nincs ilyen felhasználó: ' . $data['username'];
                }
            }
            else 
            {
                $errors[] = 'Kötelező megadni a felhasználónevet és a jelszót!';
            }
        }

        // Ha nem sikerült belépni újra megjelenítjük az oldalt
        $this->view('belepes', ['errors' => $errors]);
    }

    public function logout($data): void
    {
        Session::unset('authenticated_user_id');

        header("Location: /belepes");
        die();
    }

    public function register($data): void
    {
        // Validáció
        $errors = [];

        if (!$data['username'])
            $errors[] = 'Kötelező a felhasználónevet megadni!';
        if (User::findBy('username', $data['username']))
            $errors[] = 'Ezzel a felhasználónévvel már regisztráltak: ' . $data['username'];

        if (!$data['password'])
            $errors[] = 'Kötelező a jelszót megadni!';
        if (!$data['password_confirm'])
            $errors[] = 'Kötelező a jelszó megerősítést megadni!';
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z!@#$%]{8,20}$/', $data['password']))
            $errors[] = 'A jelszónak 8-20 karakter hosszúnak kell lennie, és legalább 1 db kisbetűt, 1 db nagybetűt, 1 db számot és 1 db speciális karaktert (!@#$%) kell tartalmaznia!';
        if ($data['password'] !== $data['password_confirm'])
            $errors[] = 'A megerősített jelszó nem egyezik meg az eredeti jelszóval!';

        if (!$data['email'])
            $errors[] = 'Kötelező az e-mail címet megadni!';
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors[] = 'Az e-mail cím nem megfelelő formátumú!';
        if (User::findBy('email', $data['email']))
            $errors[] = 'Ezzel az e-mail címmel már regisztráltak: ' . $data['email'];
        
        if (!$data['first_name'])
            $errors[] = 'Kötelező a keresztnevet megadni!';
        
        if (!$data['last_name'])
            $errors[] = 'Kötelező vezetéknevet megadni!';

        // Ha nincs validációshiba regisztráljuk
        if (empty($errors))
        {
            $user = new User([
                'username' => $data['username'],
                'password' => $data['password'],
                'email' => $data['email'],
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
            ]);

            $user->hashPassword();

            $user->save();

            $this->view('belepes', ['success' => 'Sikeres regisztráció! Kérjük jelentkezz be a(z) ' . $user->username . ' nevű felhasználóddal.']);
        }
        else
        {
            $this->view('belepes', ['errors' => $errors]);
        }
    }
}