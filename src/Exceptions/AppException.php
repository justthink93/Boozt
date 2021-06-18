<?php

namespace App\Exceptions;

use Exception;

class AppException extends ExceptionHandler
{

    function render(Exception $exception)
    {
        // TODO make exception fancy error
        return sprintf(
            '<h3>%s</h3><h4>%s</h4><h5>%s:%s</h5>',
            $exception->getCode(),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
    }
}