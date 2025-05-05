<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Message;
use App\Session;

/**
 * Kezdőlap controller-je
 */
class KapcsolatController extends Controller
{
    // Kapcsolat oldal
    public function index(): void
    {
        $this->view('kapcsolat', []);
    }

    // Üzenet mentése
    public function save($data): void
    {
        // Validáció
        $errors = [];

        if (!$data['message'])
            $errors[] = 'Kötelező üzenetet küldeni!';
        if (strlen($data['message']) > 65000)
            $errors[] = 'Az üzenet túl hosszú!';

        // Ha nincs bejelentkezve, akkor kellenek az alábbi mezők
        if (!Session::isAuthenticated())
        {
            if (!$data['sender_name'])
                $errors[] = 'Kötelező a küldő nevét megadni!';
            if (strlen($data['sender_name']) > 100)
                $errors[] = 'A küldő neve túl hosszú!';

            if (!$data['sender_email'])
                $errors[] = 'Kötelező a küldő e-mail címet megadni!';
            if (strlen($data['sender_email']) > 100)
                $errors[] = 'A küldő e-mail címe túl hosszú!';
            if (!filter_var($data['sender_email'], FILTER_VALIDATE_EMAIL))
                $errors[] = 'A küldő e-mail címe nem megfelelő formátumú!';
        }

        // Ha nincsen validációs hiba, mentjük az üzenetet
        if (empty($errors))
        {
            // Ha be van jelentkezve, id-val
            if (Session::isAuthenticated())
            {
                $message = new Message([
                    'user_id' => Session::getAuthenticatedUser()->id,
                    'message' => $data['message']
                ]);
            }
            else
            {
                $message = new Message([
                    'sender_name' => $data['sender_name'],
                    'sender_email' => $data['sender_email'],
                    'message' => $data['message']
                ]);
            }

            $message->save();

            $this->view('kapcsolat', ['success' => 'Sikeres kapcsolatfelvétel!']);
        }
        else
        {
            $this->view('kapcsolat', ['errors' => $errors]);
        }    
    }

    // Üzenetek oldal
    public function admin_index(): void
    {
        // Ha nincs bejelentkezett felhasználó
        if (Session::isAuthenticated())
        {
            $messages = Message::all(['by' => 'created_at', 'dir' => 'DESC']);

            $this->view('uzenetek', ['messages' => $messages]);
        }
        else
        {
            throw new \Exception(message: '401, nincs hozzáférés ehhez az oldalhoz!');
        }
    }
}