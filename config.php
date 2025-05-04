<?php

/**
 * KONFIGURÁCIÓS FÁJL
 */

// Oldal címe 
define('SITE_NAME', 'Majd valamit kitalálok');

// Útvonalak
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');

// Adatbázis
define('DB_HOST', 'sql');
define('DB_USER', 'webprog1-la');
define('DB_PASSWORD', 'nagyonbiztonsagosjelszo');
define('DB_NAME', 'webprog1-la');

// Menürendszer
define('MAIN_MENU', [
    [
        'title' => 'Főoldal',
        'path' => '/',
        'visible' => true
    ],
    [
        'title' => 'Képek',
        'path' => '/kepek',
        'visible' => true
    ],
    [
        'title' => 'Kapcsolat',
        'path' => '/kapcsolat',
        'visible' => true
    ],
    [
        'title' => 'Üzenetek',
        'path' => '/uzenetek',
        'visible' => true
    ],
    [
        'title' => 'Belépés',
        'path' => '/belepes',
        'visible' => true
    ],
    [
        'title' => 'Kilépés',
        'path' => '/kilepes',
        'visible' => true
    ],
]);