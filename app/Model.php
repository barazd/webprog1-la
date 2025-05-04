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
    protected $protected = [];

    private static $table = '';

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

    // Attribútum alapján hívunk be modellt
    public static function findBy(string $key, int|string $value): self|bool
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $key . ' = :' . $key;

        if ($data = DB::query($sql, [':' . $key => $value])) {
            return new static($data);
        } else {
            return false;
        }
    }

    // ID alapján hívunk be modellt
    public static function find(int|string $id): self
    {
        return self::findBy('id', $id);
    }

    // Hozzáférés a nem védett attribútumokhoz
    public function __get($key): mixed
    {
        return array_key_exists($key, $this->attributes) && in_array($key, $this->protected) ? null : $this->attributes[$key];
    }

    // Új létrehozásához SQL logika
    public function save(): bool
    {
        // SQL lekérdezések összerakása attól függően, hogy létrehoz vagy frissít
        if (!isset($this->attributes['id']))
        {
            $sql = 'INSERT INTO ' . static::$table . ' (';
            foreach ($this->attributes as $key => $value)
            {
                $sql .= $key . ', ';
            }
            $sql .= ' created_at) VALUES (';
            foreach ($this->attributes as $key => $value)
            {
                $sql .= ':' . $key . ', ';
            }
            $sql .= ' :created_at)';

            // Létrehozás dátuma
            $this->attributes['created_at'] = date("Y-m-d H:i:s");
        }
        else
        {
            $sql = 'UPDATE ' . static::$table . ' SET ';
            foreach ($this->attributes as $key => $value)
            {
                if ($key !== 'id')
                {
                    $sql .= $key . ' = :' . $key;
                }
            }
            $sql .= ' updated_at = :updated_at WHERE id = :id';

            // Frissítés dátuma
            $this->attributes['updated_at'] = date("Y-m-d H:i:s");
        }

        // Lefuttatjuk a lekérdezést
        if (DB::query($sql, $this->attributes)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Összes nem védett attribútum tömbbe, amikor nem egyenként kell lekérdezni
    public function getAttributes(): array
    {
        return array_filter($this->attributes, function(string $key): bool {
            return !in_array($key, $this->protected);
        }, ARRAY_FILTER_USE_KEY);
    }
}