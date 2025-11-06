<?php

namespace structural;

use generative\WorkerPool;

interface Worker
{
    /**
     * @param $hours
     * @return mixed
     */
    public function closedHours($hours);

    /**
     * @return int
     */
    public function countSalary(): int;

}


class WorkerTime implements Worker
{
    /**
     * @var array
     */
    protected array $hours = [];

    /**
     * @param $hours
     * @return void
     */
    public function closedHours($hours): void
    {
        $this->hours[] = $hours;
    }

    /**
     * @return int
     */
    public function countSalary(): int
    {
        return array_sum($this->hours) * 500;
    }
}

class WorkerProxy implements Worker
{
    /**
     * @var int
     */
    protected int $salary = 0;
    /**
     * @var WorkerTime
     */
    protected WorkerTime $salaryO;

    /**
     * @param WorkerTime $salary
     */
    public function __construct(WorkerTime $salary)
    {
        $this->salaryO = $salary;
    }

    /**
     * @param $hours
     * @return void
     */
    public function closedHours($hours): void
    {
        $hours = $hours * 2;
        $this->salaryO->closedHours($hours);
    }

    /**
     * @return int
     */
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