<?php

require_once __DIR__."/../autoload.php";
require_once __DIR__ . '/../app/config.php';


use App\Core\Application;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__.'/..');
$dotenv->load();

$app = new Application();

