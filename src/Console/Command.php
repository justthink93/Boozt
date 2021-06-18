<?php

namespace App\Console;

abstract class Command
{
    protected $name;
    protected $description;

    public abstract function handle($param = null);
}