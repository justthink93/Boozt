<?php

namespace App\Services\Database;

use App\Interfaces\DatabaseDriver;
use PDO;
use PDOException;

class MysqlDriver implements DatabaseDriver
{

    /**
     * @return PDO
     */
    public function connect(): PDO
    {
        $host = getenv('DB_HOST');
        $db = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
