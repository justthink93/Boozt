<?php

namespace App\Builders\Database;


use App\DataTransformers\QueryBuilderDTO;
use App\Interfaces\Builder;

class QueryBuilder implements Builder
{
    private $table;
    private $andWheres = [];
    private $orWheres = [];
    private $select = '*';
    private $count = false;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function andWhere($column, $operation = '=', $value)
    {
        $this->andWheres[] = [$column, $operation, $value];
        return $this;
    }

    public function orWhere($column, $operation = '=', $value)
    {
        $this->orWheres[] = [$column, $operation, $value];
        return $this;
    }

    public function select($select)
    {
        $this->select = $select;
        return $this;
    }

    public function count()
    {
        $this->count = true;
    }

    public function make()
    {
        $dto = new QueryBuilderDTO();
        $conditions = [];
        foreach ($this->andWheres as $andWhere) {
            $conditions[] = [$andWhere[0], $andWhere[1], $andWhere[2], 'AND'];
        }
        if (count($this->andWheres) > 0) {
            $conditions[count($conditions) - 1][3] = '';
        }
        if (count($this->andWheres) > 0 and count($this->orWheres) > 0) {
            $conditions[count($conditions) - 1][3] = 'OR';
        }
        foreach ($this->orWheres as $orWhere) {
            $conditions[] = [$orWhere[0], $orWhere[1], $orWhere[2], 'OR'];
        }
        if (count($this->orWheres) > 0) {
            $conditions[count($conditions) - 1][3] = '';
        }
        $dto->setData('table', $this->table);
        $dto->setData('columns', $this->select);
        $dto->setData('conditions', $conditions);
        $dto->setData('count', $this->count);

        return $dto;
    }
}