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
        $this->view('kepek', []);
    }

    public function upload($data): void
    {
        var_dump($data);
        $uploadfile = APP_ROOT . '/public/storage/' . uniqid() . uniqid() . '.' . end(explode('.', $_FILES['file']['name']));

        $photo = new Photo([
            'user_id' => 1,
            'title' => $data['title'],
            'original_name' => $_FILES['file']['name'],
            'path' => $uploadfile
        ]);
        var_dump($photo);
        var_dump($_FILES['file']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
        {
            $photo->save();
        }
        else
        {
            print 'HIBA';
        }
        
        /*if (Session::isAuthenticated())
        {

        }/*/
        //$this->view('kepek', []);
    }
}