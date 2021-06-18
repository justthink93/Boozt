<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/bootstrap/bootstrap.php';

use App\Core\Request;

echo $app->handleRequest(new Request($_SERVER, $_POST, $_GET, $_FILES));

$app->terminate();
