<?php

namespace generative;

class WorkerPool
{
    private array $freeWorkers = [];
    private array $busyWorkers = [];

    public function getFreeWorkers(): array
    {
        return $this->freeWorkers;
    }

    public function setFreeWorkers(array $freeWorkers): void
    {
        $this->freeWorkers = $freeWorkers;
    }

    public function getBusyWorkers(): array
    {
        return $this->busyWorkers;
    }

    public function setBusyWorkers(array $busyWorkers): void
    {
        $this->busyWorkers = $busyWorkers;
    }

    public function getWorker(): Worker
    {
        if (count($this->freeWorkers) === 0)
        {
            $worker = new Worker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->busyWorkers[spl_object_hash($worker)] = $worker;
        return $worker;
    }
    public function release(Worker $worker)
    {
        $key = spl_object_hash($worker);
        if (isset($this->busyWorkers[$key])) {
            unset($this->busyWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }

    }
}

class Worker
{
    public function work()
    {
        printf("I'm working");
    }
}

$pool = new WorkerPool();
$worker = $pool->getWorker();
$worker->work();
$worker2 = $pool->getWorker();
$worker2->work();
$worker3 = $pool->getWorker();
$worker3->work();
$pool->release($worker);
var_dump($pool->getBusyWorkers());
var_dump($pool->getFreeWorkers());