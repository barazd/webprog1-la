<?php

namespace App;

use PDO;
use PDOException;

/**
 * DB
 * Újrahsználható adatbáziskapcsolat
 */
abstract class DB
{
    private static $config = [
        'username' => DB_USER,
        'password' => DB_PASSWORD,
        'dsn' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '',
    ];

    public static function connect(): PDO
    {
        $pdo = new PDO(self::$config['dsn'], self::$config['username'], self::$config['password']);

        return $pdo;
    }

    public static function query(string $sql, array $params = [])
    {
        try {
            $pdo = self::connect();
            
            $query = $pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $query->bindParam($key, $value, gettype($value) === 'integer' ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            //$query->setFetchMode(PDO::FETCH_CLASS, get_called_class());

            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            throw new \Exception('500, hiba a lekérdezésben: ' . $e->getMessage());
        }
        
    }
}