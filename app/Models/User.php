<?php

namespace App\Models;

use App\Model;

/**
 * FELHASZNÁLÓ
 */
class User extends Model
{
    private $protected = [
        'password'
    ];

    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->password);
    }

    private function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}