<?php

/**
 * KONFIGURÁCIÓS FÁJL
 */

// Oldal címe 
define('SITE_NAME', 'Majd valamit kitalálok');

// Útvonalak
define('APP_ROOT', dirname(__FILE__));
define('URL_ROOT', '/');

// Adatbázis
define('DB_HOST', 'webprog1-la-sql');
define('DB_USER', 'webprog1-la');
define('DB_PASSWORD', 'nagyonbiztonsagosjelszo');
define('DB_NAME', 'webprog1-la');

// Menürendszer
define('MAIN_MENU', [
    [
        'title' => 'Főoldal',
        'path' => '/',
    ],
    [
        'title' => 'Képek',
        'path' => '/kepek',
    ],
    [
        'title' => 'Kapcsolat',
        'path' => '/kapcsolat',
    ],
    [
        'title' => 'Üzenetek',
        'path' => '/uzenetek',
        'authenticated' => true
    ],
    [
        'title' => 'Belépés',
        'path' => '/belepes',
        'authenticated' => false
    ],
    [
        'title' => 'Kilépés',
        'path' => '/kilepes',
        'authenticated' => true
    ],
]);