<?php

namespace generative;

abstract class DeveloperPrototype
{
    protected string $name;
    protected string $positions;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPositions(): string
    {
        return $this->positions;
    }

    public function setPositions(string $positions): void
    {
        $this->positions = $positions;
    }

}
class Developer extends DeveloperPrototype
{
    protected string $positions = 'Developer';

}

$developer = new Developer();
$developer2prototype = clone $developer;
$developer2prototype->setName('Boris');
var_dump($developer2prototype->getName());