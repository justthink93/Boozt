<?php

namespace App\Models;

use App\Builders\Database\QueryBuilder;
use App\Factory\DBDriverFactory;
use App\Services\Database\EntityManager;
use Exception;

class Model
{

    protected $tableName = '';
    protected $primaryKey = '';
    protected $columns = [];
    private $database;

    /**
     * Model constructor.
     * @throws Exception
     */
    function __construct()
    {
        $this->columns = array();
        $dbDriver = DBDriverFactory::getDriver('mysql');

        $this->database = new EntityManager($dbDriver);
    }

    public function __get($column)
    {
        return $this->columns[$column];
    }

    public function __set($column, $value)
    {
        $this->columns[$column] = $value;
    }

    public function save()
    {
        $id = $this->database->replace($this->tableName, $this->columns);
        $this->id = $id;
    }

    public function getById($id)
    {
        $row = $this->database->getOne($this->tableName, '*',[['id', '=', $id, '']]);
        $class = get_called_class();
        $model = new $class();
        $model->loadFromDb($row);
        return $model;
    }

    public function loadFromDb($columns)
    {
        foreach ($columns as $key => $value) {
            $this->columns[$key] = $value;
        }
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return new QueryBuilder($this->tableName);
    }

    public function getFromQueryBuilder(QueryBuilder $qb)
    {
        return $this->database->getByQueryBuilder($qb);
    }
}