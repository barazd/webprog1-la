<?php

namespace App\Models;

use App\Model;

/**
 * Üzenet
 */
class Message extends Model
{
    protected $protected = [
    ];

    public static $table = 'messages';

    // Regsiztrált küldte-e vagy sem, és ennek függvényében az adatok
    public function getSenderDetails(): array
    {
        if ($this->user_id)
        {
            $user = User::find($this->user_id);
            return [
                'registered' => true,
                'name' => $user->username,
                'email' => $user->email
            ];
        }
        else
        {
            return [
                'registered' => false,
                'name' => $this->sender_name,
                'email' => $this->sender_email
            ];
        }
    }

}