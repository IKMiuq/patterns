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
class WorkerProxy implements Worker
{
    protected int $salary = 0;
    protected WorkerTime $salaryO;

    public function __construct(WorkerTime $salary)
    {
        $this->salaryO = $salary;
    }

    public function closedHours($hours)
    {
        $hours = $hours*2;
        $this->salaryO->closedHours($hours);
    }
    public function countSalary(): int
    {
        if ($this->salary === 0) {
            return $this->salaryO->countSalary();
        }
        return 0;
    }
}

$work = new WorkerTime();
$workerProxy = new WorkerProxy($work);
$workerProxy->closedHours(10);
$salary = $workerProxy->countSalary();
var_dump($salary);
$workerProxy->closedHours(10);
$salary = $workerProxy->countSalary();

var_dump($salary);