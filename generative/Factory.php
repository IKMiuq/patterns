<?php

namespace generative;

class Factory
{
    public string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

class FactoryWorker
{
    public static function make($name): Factory
    {
        return new Factory($name);

    }
}

$factory = new FactoryWorker();
$newFactory = $factory->make('Фабрика');
var_dump($newFactory->name);