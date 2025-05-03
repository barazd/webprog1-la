<?php

/**
 * Az összes app mappában lévő fájl autoload-olása
 */

spl_autoload_register(function ($class): bool {
    // Mappák és almappák
    $directories = glob(__DIR__ . '/app/*', GLOB_ONLYDIR);

    // Végigiterálunk
    // TODO: ha sok időm lesz, akkor cache
    foreach ($directories as $directory) {
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $directory) . DIRECTORY_SEPARATOR . $class . '.php';
        // Ha olvasható a fájl
        if (is_readable($filename)) {
            require_once $filename;
            break;
        }
    }
    return true;
});