<?php

namespace App\Services;


use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Models\Model;

class CustomerRepositoryService extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function totalCustomers()
    {
        $queryBuilder = $this->model->getQueryBuilder();
        $queryBuilder->count();
        $result = $this->model->getFromQueryBuilder($queryBuilder);
        return $result;
    }
}