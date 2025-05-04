<?php

namespace App;

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
    public function unset(): void
    {
        session_unset();
    }

    // Tulajdonság lekérése 
    public function __get(string $key): mixed
    {
        return (array_key_exists( $key, $_SESSION) ? $_SESSION[$key] : null);
    }

    // Tulajdonság beállítása
    public function __set(string $key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }
}