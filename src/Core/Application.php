<?php

namespace App\Core;


use App\Exceptions\AppException;
use App\Providers\ServiceProvider;
use Exception;

class Application
{
    private $serviceProvider;
    private $dependenciesContainer;
    private $exceptionHandler;

    public function __construct()
    {
        $this->serviceProvider = new ServiceProvider(new Container());
        $this->dependenciesContainer = $this->serviceProvider->boot();
        $this->exceptionHandler = new AppException();
    }

    public function handleRequest(Request $request)
    {
        try {
            $controller = $request->getController();
            $method = $request->getMethod($controller);
            $controller = $this->dependenciesContainer->get($controller);
            return $controller->$method();
        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    public function handleException(Exception $exception)
    {
        return $this->exceptionHandler->render($exception);
    }

    public function getDependenciesContainer()
    {
        return $this->dependenciesContainer;
    }

    public function terminate()
    {
        exit();
    }
}