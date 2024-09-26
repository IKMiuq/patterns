<?php

namespace structural;

use generative\WorkerPool;

interface Worker
{
    public function closedHours($hours);
    public function countSalary(): int;

}
class WorkerTime implements Worker
{
    protected array $hours = [];
    public function closedHours($hours)
    {
        $this->hours[] = $hours;
    }
    public function countSalary(): int
    {
        return array_sum($this->hours) * 500;
    }
}
class WorkerProxy extends WorkerTime implements Worker
{
    protected int $salary = 0;

    public function countSalary(): int
    {
        if ($this->salary === 0) {
            $this->salary = parent::countSalary();
        }
        return $this->salary;
    }
}

$workerProxy = new WorkerProxy();
$workerProxy->closedHours(10);
$salary = $workerProxy->countSalary();
$workerProxy->closedHours(10);
$salary = $workerProxy->countSalary();

var_dump($salary);