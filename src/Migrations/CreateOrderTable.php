<?php

namespace App\Migrations;

use App\Builders\Database\ColumnBuilder;
use App\Builders\Database\SchemaBuilder;
use App\Services\Database\DatabaseMaker;
use DateTime;

class CreateOrderTable extends Migration
{
    /**
     * @throws \Exception
     */
    function up()
    {
        $schema = (new SchemaBuilder("orders"))
            ->addColumn(
                (new ColumnBuilder('id'))
                    ->setType('INT')
                    ->setNullable(false)
                    ->setExtra('AUTO_INCREMENT')
            )->addColumn(
                (new ColumnBuilder('customer_id'))
                    ->setType('INT')
                    ->setNullable(false)
            )->addColumn(
                (new ColumnBuilder('purchase_date'))
                    ->setType('datetime')
            )->addColumn(
                (new ColumnBuilder('country'))
                    ->setType('VARCHAR(200)')
                    ->setNullable(true)
            )->setPrimaryKey('id')
            ->setForeignKey('customer_id', 'customers', 'id');

        $database = new DatabaseMaker($schema);
        echo $database->create();
    }
}