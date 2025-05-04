<?php

/**
 * Az összes app mappában lévő fájl autoload-olása
 */

define('CLASS_REPLACE', [
    '\\' => DIRECTORY_SEPARATOR,
    'App' => 'app'
]);

spl_autoload_register(function ($class): bool
{
    // Mappák és almappák
    //$directories = glob(__DIR__ . '/*', GLOB_ONLYDIR);

    // Végigiterálunk
    // TODO: ha sok időm lesz, akkor cache

    $filename = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';

    foreach ( CLASS_REPLACE as $search => $replace)
    {
        $filename = str_replace($search, $replace, $filename);
    }

    // Ha olvasható a fájl
    if (is_readable($filename)) {
        require_once $filename;
        return true;
    }
    else {
        throw new \Exception(message: '500, az osztály nem betölthető: ' . $filename);
    }
});