<?php

namespace App\Factory;

use App\Services\Database\MysqlDriver;
use Exception;

class DBDriverFactory
{
    private static $DBDrivers = [
        'mysql' => MysqlDriver::class
    ];

    /**
     * @param $dbDriverName
     * @return mixed
     * @throws Exception
     */
    public static function getDriver($dbDriverName)
    {
        if (!array_key_exists($dbDriverName, self::$DBDrivers)) {
            throw new Exception('Database Driver Not found!');
        }
        return new self::$DBDrivers[$dbDriverName]();
    }
}