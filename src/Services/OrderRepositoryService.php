<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepositoryService extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function totalOrderCount()
    {
        $queryBuilder = $this->model->getQueryBuilder();
        $queryBuilder->count();
        $result = $this->model->getFromQueryBuilder($queryBuilder);
        return $result;
    }
}