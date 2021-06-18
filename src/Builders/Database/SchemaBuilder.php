<?php

namespace App\Builders\Database;

use App\Interfaces\Builder;

class SchemaBuilder implements Builder
{
    protected $columns = [];
    protected $table = '';
    protected $primaryKey = '';
    protected $foreignKey = null;
    protected $referenceTable = null;
    protected $referenceKey = null;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function setPrimaryKey($primary)
    {
        $this->primaryKey = $primary;
        return $this;
    }

    public function setForeignKey($foreignKey, $referenceTable, $referenceKey)
    {
        $this->foreignKey = $foreignKey;
        $this->referenceTable = $referenceTable;
        $this->referenceKey = $referenceKey;
        return $this;
    }

    public function addColumn(ColumnBuilder $column)
    {
        $this->columns[] = $column;
        return $this;
    }

    public function make()
    {
        $sql = "CREATE TABLE {$this->table} (";
        foreach ($this->columns as $column) {
            $sql .= $column->make() . ',';
        }
        $sql .= "PRIMARY KEY(" . $this->primaryKey . ")";
        if ($this->foreignKey != null) {
            $sql .= ", FOREIGN KEY ({$this->foreignKey}) REFERENCES {$this->referenceTable} ({$this->referenceKey})";
        }
        $sql .= ");";
        return $sql;
    }
}