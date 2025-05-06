<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Photo;
use App\Models\User;
use App\Session;

/**
 * Képek oldal controller-je
 */
class KepekController extends Controller
{
    public function index(): void
    {
        $this->view('kepek', ['photos' => Photo::all()]);
    }

    // Feltöltés logikája
    public function upload($data): void
    {
        // Ha be van jelentkezve
        if (Session::isAuthenticated())
        {
            // Validáció
            $errors = [];

            if (empty($errors))
            {
                // Feltöltés útvonala
                $relativePath = '/storage/' . bin2hex(random_bytes(16)) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $fullPath = APP_ROOT . '/public' . $relativePath;

                $photo = new Photo([
                    'user_id' => 1,
                    'title' => $data['title'],
                    'original_name' => $_FILES['file']['name'],
                    'path' => $relativePath
                ]);

                // Mentés a végleges helyre
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fullPath))
                {
                    // Ha sikerült létrehozzuk az adatbázisban is
                    $photo->save();

                    $this->view('kepek', ['success' => 'Sikertes mentés!', 'photos' => Photo::all()]);
                }
                else
                {
                    // Ha nem sikerült, akkor hiba
                    $this->view('kepek', ['errors' => ['Sikertelen mentés!']]);
                }
            }
            else
            {
                $this->view('kepek', ['errors' => $errors]);
                
            }
        }
        else
        {
            throw new \Exception(message: '401, nincs hozzáférés ehhez az oldalhoz!');
        }
    }
}