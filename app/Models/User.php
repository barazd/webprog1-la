<?php

namespace App\Models;

use App\Model;

/**
 * FELHASZNÁLÓ
 */
class User extends Model
{
    protected $protected = [
        'password'
    ];

    public static $table = 'users';

    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->attributes['password']);
    }

    public function hashPassword(): void
    {
        $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
    }
}