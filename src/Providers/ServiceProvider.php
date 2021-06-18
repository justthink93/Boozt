<?php

namespace App\Providers;

use App\Controllers\DashboardController;
use App\Core\Container;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Customer;
use App\Models\Order;
use App\Services\CustomerRepositoryService;
use App\Services\OrderRepositoryService;

class ServiceProvider
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function boot()
    {
        $this->container->set(OrderRepositoryInterface::class, OrderRepositoryService::class);
        $this->container->set(CustomerRepositoryInterface::class, CustomerRepositoryService::class);

        return $this->container;
    }

}