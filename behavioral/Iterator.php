<?php

namespace behavioral;

class WorkerList
{
    private array $list = [];
    private int $index = 0;

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getItem($key): ?Worker
    {
        if ($this->list[$key])
            return $this->list[$key];
        return null;
    }
    public function next()
    {
        if ($this->index < count($this->list) - 1)
            $this->index++;
    }
    public function prev()
    {
        if ($this->index !== 0)
            $this->index--;
    }

    public function getByIndex()
    {
        return $this->list[$this->index];
    }
}

class Worker
{
    private string $name = '';

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}

$worker1 = new Worker('Anna');
$worker2 = new Worker('Maria');
$worker3 = new Worker('Sveta');
$workerList = new WorkerList();
$workerList->setList([$worker1,$worker2,$worker3]);
var_dump($workerList->getByIndex()->getName());
$workerList->next();
var_dump($workerList->getByIndex()->getName());
$workerList->prev();
var_dump($workerList->getByIndex()->getName());