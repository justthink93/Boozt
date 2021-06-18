<?php

namespace App\Exceptions;

use Exception;

abstract class ExceptionHandler
{
    abstract function render(Exception $exception);
}