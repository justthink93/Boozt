<?php

namespace App\DataTransformers;

class QueryBuilderDTO
{
    private $data = [];

    public function getData($key)
    {
        return $this->data[$key];
    }

    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }
}