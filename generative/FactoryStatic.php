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

class WorkerFactory
{
    public static function make($worker): ?Worker
    {
        $className = strtoupper($worker);
        if (class_exists($className)) {
            return new $className();
        }
        return null;
    }
}
