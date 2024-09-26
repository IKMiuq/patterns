<?php

namespace behavioral;

use generative\Designer;

interface Definer
{
    public function define($arg);
}

class Data
{
    private Definer $definer;
    private int|string|bool $arg;

    /**
     * @param Definer $definer
     */
    public function __construct(Definer $definer)
    {
        $this->definer = $definer;
    }

    public function executeStrategy(): string
    {
        return $this->definer->define($this->arg);
    }

    public function setArg(bool|int|string $arg): void
    {
        $this->arg = $arg;
    }

    public function setNewDefiner(Definer $definer): void
    {
        $this->definer = $definer;
    }
}
class NumberStrategy implements Definer
{
    public function define($arg):string
    {
        return $arg . 'from int strategy';
    }
}
class StringStrategy implements Definer
{
    public function define($arg): string
    {
        return $arg . 'from string strategy';
    }
}
class BoolStrategy implements Definer
{
    public function define($arg): string
    {
        return $arg . 'from bool strategy';
    }

}

$data = new Data(new NumberStrategy());
$data->setArg('some arg for first ');
var_dump($data->executeStrategy());
$data->setNewDefiner(new StringStrategy());
var_dump($data->executeStrategy());
$data->setNewDefiner(new BoolStrategy());
var_dump($data->executeStrategy());