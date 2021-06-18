<?php


namespace App\Migrations;


use App\Builders\Database\ColumnBuilder;
use App\Builders\Database\SchemaBuilder;
use App\Services\Database\DatabaseMaker;
use DateTime;

class CreateOrderItemTable extends Migration
{
    /**
     * @throws \Exception
     */
    function up()
    {
        $schema = (new SchemaBuilder("order_items"))
            ->addColumn(
                (new ColumnBuilder('id'))
                    ->setType('INT')
                    ->setNullable(false)
                    ->setExtra('AUTO_INCREMENT')
            )->addColumn(
                (new ColumnBuilder('order_id'))
                    ->setType('INT')
                    ->setNullable('false')
            )->addColumn(
                (new ColumnBuilder('EAN'))
                    ->setType('VARCHAR(100)'))
            ->addColumn(
                (new ColumnBuilder('quantity'))
                    ->setType('INT')
                    ->setDefault(0)
            )->addColumn(
                (new ColumnBuilder('price'))
                    ->setType('DECIMAL(10,2)')
                    ->setNullable(false)
            )->setPrimaryKey('id')
            ->setForeignKey('order_id', 'orders', 'id');
        $database = new DatabaseMaker($schema);
        $database->create();
    }
}