<?php

namespace App;

use App\Models\User;

/**
 * Egyszerű session kezelés
 */
class Session
{
    private static function init()
    {
        // Ha még nincs session, elkezdünk egyet
        if (session_status() === PHP_SESSION_NONE) {

            session_cache_expire(1440); // 1 nap

            session_start();
        }
    }

    // Session törlése
    public static function unset(string $key = ''): void
    {
        self::init();
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
    public static function get(string $key): mixed
    {
        self::init();
        return (array_key_exists( $key, $_SESSION) ? $_SESSION[$key] : null);
    }

    // Tulajdonság beállítása
    public static function set(string $key, $value): void
    {
        self::init();
        $_SESSION[$key] = $value;
    }

    // Be van-e jelentkezve
    public static function isAuthenticated(): bool
    {
        return self::get('authenticated_user_id') !== null;
    }

    // Bejelentkezett felhasználó
    public static function getAuthenticatedUser(): ?User
    {
        if (self::isAuthenticated())
        {
            return User::find(self::get('authenticated_user_id'));
        }
        return null;
    }
}