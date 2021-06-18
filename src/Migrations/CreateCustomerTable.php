<?php

namespace App\Migrations;


use App\Builders\Database\ColumnBuilder;
use App\Builders\Database\SchemaBuilder;
use App\Services\Database\DatabaseMaker;

class CreateCustomerTable extends Migration
{
    /**
     * @throws \Exception
     */
    function up()
    {
        $schema = (new SchemaBuilder("customers"))
            ->addColumn(
                (new ColumnBuilder('id'))
                    ->setType('INT')
                    ->setNullable(false)
                    ->setExtra('AUTO_INCREMENT')
            )->addColumn(
                (new ColumnBuilder('first_name'))
                    ->setType('VARCHAR(200)')
                    ->setNullable('false')
            )->addColumn(
                (new ColumnBuilder('last_name'))
                    ->setType('VARCHAR(200)')
                    ->setNullable(false))
            ->addColumn(
                (new ColumnBuilder('email'))
                    ->setType('VARCHAR(200)')
                    ->setNullable(false)
            )->setPrimaryKey('id');
        $database = new DatabaseMaker($schema);
        $database->create();
    }
}