<?php

namespace App\Services\Database;

use App\Builders\Database\SchemaBuilder;
use App\Factory\DBDriverFactory;
use Exception;

class DatabaseMaker
{
    private $schema;
    private $database;

    /**
     * DatabaseMaker constructor.
     * @param SchemaBuilder $schema
     * @throws Exception
     */
    public function __construct(SchemaBuilder $schema)
    {
        $this->schema = $schema;
        $dbDriver = DBDriverFactory::getDriver('mysql');
        $this->database = new EntityManager($dbDriver);
    }

    public function create()
    {
        $sql = $this->schema->make();
        return $this->database->execStatement($sql);
    }
}