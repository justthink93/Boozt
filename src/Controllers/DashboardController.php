<?php

namespace App\Controllers;

use App\Core\Template;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Services\OrderRepositoryService;
use Exception;

class DashboardController extends BaseController
{
    private $orderRepositoryService;
    private $customerRepositoryService;

    public function __construct(OrderRepositoryInterface $orderRepositoryService, CustomerRepositoryInterface $customerRepositoryService)
    {
        parent::__construct(new Template());
        $this->orderRepositoryService = $orderRepositoryService;
        $this->customerRepositoryService = $customerRepositoryService;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function indexMethod()
    {
        $totalOrdersCount = $this->orderRepositoryService->totalOrderCount();
        $totalCustomersCount = $this->customerRepositoryService->totalCustomers();

        return parent::getView(
            __METHOD__,
            [
                'title' => APP_NAME . ' - Home',
                'header' => 'Welcome to ' . APP_NAME,
                'dashboard' => APP_NAME,
                'totalCustomersCount' => $totalCustomersCount,
                'totalOrdersCount' => $totalOrdersCount
            ]
        );
    }
}