<?php

namespace generative;

interface Worker
{
    public function work();
}
class Developer implements Worker
{
    public function work()
    {
        printf("I'm developer");
    }
}

class Designer implements Worker
{
    public function work()
    {
        printf("I'm designer");
    }
}

interface WorkerFactory
{
    public static function make();
}

class DeveloperFactory implements WorkerFactory
{
    public static function make()
    {
        return new Developer();
    }
}
class DesignerFactory implements WorkerFactory
{
    public static function make()
    {
        return new Designer();
    }

}