<?php

namespace App\Interfaces;

use PDO;

interface DatabaseDriver
{
    public function connect():PDO;

}