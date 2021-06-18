<?php


namespace App\Console;

class MigrationCommand extends Command
{
    protected $name = 'Migration';
    protected $description = 'Create database tables';

    public function handle($param = null)
    {
        $migrationClassName = "App\\Migrations\\".$param;
        $migrationClass = new $migrationClassName();
        return $migrationClass->up();
    }
}