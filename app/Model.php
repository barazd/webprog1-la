<?php

namespace App;

use App\DB;

/**
 * MODEL
 * Ez az ősosztály a modellekhez
 */
abstract class Model
{
    // Azok a mezők, amikhez automatikusan nem lehet hozzá férni
    private $protected = [];

    // A modell attribútumai
    protected $attributes = [];

    // Feltöltjük az adatokkal a modellt
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }
    private function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    // ID alapján hívunk be modellt
    public static function find(int | string $id): self
    {
        $sql = 'SELECT * FROM users WHERE id = :id';

        $data = DB::query($sql, [':id' => $id]);

        $model = new static($data);
        
        return $model;
    }

    // Hozzáférés a nem védett attribútumokhoz
    public function __get($key): mixed
    {
        return in_array($key, $this->protected) ? false : $this->attributes[$key];
    }
}