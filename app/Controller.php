<?php

namespace App;

/**
 * CONTROLLER
 * Ez az ősosztály a kontrollerekhez
 */
abstract class Controller
{
    // View-ok egyszerű betöltése
    protected function view(string $name, array $data = []): void
    {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $name . '.php';

        // TODO: route és authentikált adatok injektálása ITT
        $data['route'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (is_readable($filename)) {
            extract($data);

            include_once $filename;
        }
        else
        {
            throw new \Exception(message: '500, a view nem található: ' . $filename);
        }
        
    }
}