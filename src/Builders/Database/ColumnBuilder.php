<?php

namespace App\Builders\Database;

use App\Interfaces\Builder;

class ColumnBuilder implements Builder
{
    protected $columnName = '';
    protected $columnType = '';
    protected $nullable = true;
    protected $defaultValue = null;
    protected $extra = '';

    public function __construct($colName)
    {
        $this->columnName = $colName;
    }

    public function setName($name)
    {
        $this->columnName = $name;
        return $this;
    }

    public function setExtra($extra)
    {
        $this->extra = $extra;
        return $this;
    }

    public function setType($type)
    {
        $this->columnType = $type;
        return $this;
    }

    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }

    public function setDefault($value)
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function make()
    {
        return "{$this->columnName} {$this->columnType} " .
            (($this->nullable == true) ? '' : 'NOT ' . 'NULL ') .
            " {$this->extra} " .
            (($this->defaultValue == null) ? '' : "DEFAULT {$this->defaultValue}");
    }
}