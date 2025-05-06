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
    public function upload($request): void
    {
        // Ha be van jelentkezve
        if (Session::isAuthenticated())
        {
            $data = [];

            // Validáció
            $errors = [];

            if (!$request['title'])
                $errors[] = 'Kötelező a kép címét megadni!';
            if (strlen($request['title']) > 100)
                $errors[] = 'A kép címe túl hosszú!';

            if (empty($_FILES['file']))
                $errors[] = 'Kötelező képet feltölteni!';
            if (!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif']))
                $errors[] = 'A kép kiterjesztése nem megengedett!';
            if ($_FILES['file']['size'] > 10*1024*1024)
                $errors[] = 'A kép mérete túl nagy!';
            if ($_FILES['file']['error'])
                $errors[] = 'Hiba történt a feltöltés közben: #' . $_FILES['file']['error'];

            if (empty($errors))
            {
                // Feltöltés útvonala
                $relativePath = '/storage/' . bin2hex(random_bytes(16)) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $fullPath = APP_ROOT . '/public' . $relativePath;

                $photo = new Photo([
                    'user_id' => 1,
                    'title' => $request['title'],
                    'original_name' => $_FILES['file']['name'],
                    'path' => $relativePath
                ]);

                // Mentés a végleges helyre
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fullPath))
                {
                    // Ha sikerült létrehozzuk az adatbázisban is
                    $photo->save();

                    $data += ['success' => 'Sikertes mentés!'];
                }
                else
                {
                    // Ha nem sikerült, akkor hiba
                    $data += ['errors' => ['Sikertelen mentés!']];
                }
            }
            else
            {
                $data += ['errors' => $errors];
            }

            $data += ['photos' => Photo::all()];
            $this->view('kepek', $data);
        }
        else
        {
            throw new \Exception(message: '401, nincs hozzáférés ehhez az oldalhoz!');
        }
    }
}