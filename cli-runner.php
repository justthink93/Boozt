<?php

require_once __DIR__ . '/bootstrap/bootstrap.php';

$className = "App\\Console\\" . $argv[1] . "Command";
$dc = $app->getDependenciesContainer();
try {
    $command = $dc->get($className);
    echo $command->handle($argv[2]);
} catch (Exception $exception) {
    echo $app->handleException($exception);
    $app->terminate();
}