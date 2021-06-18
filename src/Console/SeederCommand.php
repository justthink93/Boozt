<?php


namespace App\Console;


class SeederCommand extends Command
{
    // TODO use these data to inform user
    protected $name = 'Seeder';
    protected $description = 'Seed database';

    public function handle($param = null)
    {
        $seederClassName = "App\\Seeders\\" . $param;
        $seederClass = new $seederClassName();
        return $seederClass->run();
    }
}