<?php

namespace App\Services\Database;

use App\Builders\Database\QueryBuilder;
use App\Interfaces\DatabaseDriver;
use PDO;

class EntityManager
{
    private $pdo;

    public function __construct(DatabaseDriver $dbdriver)
    {
        $this->pdo = $dbdriver->connect();
    }

    public function insert($table, $data)
    {
        $bindValuesArray = [];
        foreach ($data as $key => $value) {
            $bindValuesArray[":" . $key] = $value;
        }
        $sql = "INSERT INTO {$table}(" . implode(',', array_keys($data)) . ") VALUES (:" . implode(
                ',',
                array_keys($bindValuesArray)
            ) . ")";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($bindValuesArray);
        return $this->pdo->lastInsertId();
    }

    public function replace($table, $data)
    {
        $bindValuesArray = [];
        foreach ($data as $key => $value) {
            $bindValuesArray[":" . $key] = $value;
        }
        $sql = "REPLACE INTO {$table}(" . implode(',', array_keys($data)) . ") VALUES (" . implode(
                ',',
                array_keys($bindValuesArray)
            ) . ")";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($bindValuesArray);
        return $this->pdo->lastInsertId();
    }

    public function getOne($table, $columns = '*', $conditions = [], $order = null)
    {
        $conditionData = [];
        $query = "SELECT {$columns} FROM {$table}";
        if (!empty($conditions)) {
            $query .= " WHERE ";
            foreach ($conditions as $condition) {
                // e.g. WHERE name=:name and
                $query .= $condition[0] . $condition[1] . ":" . $condition[0] . " {$condition[3]} ";
                $conditionData[$condition[0]] = $condition[2];
            }
        }
        if ($order) {
            $query = rtrim($query, ' AND ');
            $query .= " ORDER BY " . $order;
        }
        $query .= " LIMIT 1";
        return $this->get($query, $conditionData);
    }

    public function get($query, $conditionData = [])
    {
        $statement = $this->pdo->prepare($query);
        foreach ($conditionData as $key => $value) {
            $conditionData[':' . $key] = $value;
            unset($conditionData[$key]);
        }
        $statement->execute($conditionData);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getByQueryBuilder(QueryBuilder $qb)
    {
        $queryBuilderDto = $qb->make();
        if ($queryBuilderDto->getData('count') == true) {
            $data = $this->getCount(
                $queryBuilderDto->getData('table'),
                $queryBuilderDto->getData('conditions')
            );
        } else {
            $data = $this->getAll(
                $queryBuilderDto->getData('table'),
                $queryBuilderDto->getData('columns'),
                $queryBuilderDto->getData('conditions')
            );
        }

        return $data;
    }

    public function getCount($table, $conditions = [], $order = null)
    {
        $query = "SELECT COUNT(*) FROM " . $table;
        $conditionData = [];
        if (!empty($conditions)) {
            $query .= " WHERE ";
            foreach ($conditions as $key => $condition) {
                // e.g. WHERE name=:name and
                $query .= $condition[0] . $condition[1] . ":" . $condition[0] . $key . " {$condition[3]} ";
                $conditionData[$condition[0] . $key] = $condition[2];
            }
        }
        if ($order) {
            $query = rtrim($query, ' AND ');
            $query .= " ORDER BY " . $order;
        }
        $countArr = $this->get($query, $conditionData);
        return array_values($countArr[0])[0];
    }

    public function getAll($table, $columns = '*', $conditions = [], $order = null)
    {
        $conditionData = [];
        $query = "SELECT {$columns} FROM {$table}";
        if (!empty($condition)) {
            $query .= " WHERE ";
            foreach ($conditions as $key => $condition) {
                // e.g. WHERE name=:name and
                $query .= $condition[0] . $condition[1] . ":" . $condition[0] . $key . " {$condition[3]} ";
                $conditionData[$condition[0] . $key] = $condition[2];
            }
        }
        if ($order) {
            $query = rtrim($query, ' AND ');
            $query .= " ORDER BY " . $order;
        }
        return $this->get($query, $conditionData);
    }

    public function execStatement($statement)
    {
        return $this->pdo->exec($statement);
    }
}