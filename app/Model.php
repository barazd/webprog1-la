<?php

namespace App;

use App\DB;
use Exception;

/**
 * MODEL
 * Ez az ősosztály a modellekhez
 */
abstract class Model
{
    // Azok a mezők, amikhez automatikusan nem lehet hozzá férni
    private $protected = [];

    // A modell attribútumai
    private $attributes = [];

    // Feltöltjük az adatokkal a modellt
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    private function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    // Attribútum alapján hívunk be modellt
    public static function findBy(string $key, int|string $value): self | bool
    {
        $sql = 'SELECT * FROM users WHERE ' . $key . ' = :' . $key;

        if ($data = DB::query($sql, [':' . $key => $value]))
        {
            return new static($data);
        }
        else
        {
            return false;
        }    
    }

    // ID alapján hívunk be modellt
    public static function find(int | string $id): self
    {        
        return self::findBy('id', $id);
    }

    // Hozzáférés a nem védett attribútumokhoz
    public function __get($key): mixed
    {
        return array_key_exists($key, $this->attributes) && in_array($key, $this->protected) ? null : $this->attributes[$key]; 
    }
}