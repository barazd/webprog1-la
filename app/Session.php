<?php

namespace App;

use App\Models\User;

/**
 * Egyszerű session kezelés
 */
class Session
{
    public function __construct()
    {
        // Ha még nincs session, elkezdünk egyet
        if (session_status() === PHP_SESSION_NONE) {

            session_cache_expire(1440); // 1 nap

            session_start();
        }
    }

    // Session törlése
    public function unset(string $key = ''): void
    {
        if(!empty($key))
        {
            unset($_SESSION[$key]);
        }
        else
        {
            session_unset();
        }
    }

    // Tulajdonság lekérése 
    public function __get(string $key): mixed
    {
        return (array_key_exists( $key, $_SESSION) ? $_SESSION[$key] : null);
    }

    // Tulajdonság beállítása
    public function __set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    // Be van-e jelentkezve
    public function isAuthenticated(): bool
    {
        return isset($_SESSION['authenticated_user_id']);
    }

    // Bejelentkezett felhasználó
    public function getAuthenticatedUser(): ?User
    {
        if ($this->isAuthenticated())
        {
            return User::find($_SESSION['authenticated_user_id']);
        }
        return null;
    }
}