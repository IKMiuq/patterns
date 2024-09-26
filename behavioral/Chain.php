<?php

namespace behavioral;

use structural\Service;

abstract class Handler
{
    private ?Handler $successor;

    /**
     * @param Handler $successor
     */
    public function __construct(?Handler $successor)
    {
        $this->successor = $successor;
    }

    final public function handle(TaskInterface $task)
    {
        $procesed = $this->processing($task);
        if ($procesed === null && $this->successor) {
            $procesed = $this->successor->handle($task);
        }
        return $procesed;
    }

    abstract function processing(TaskInterface $task): ?array;
}

interface TaskInterface
{
    public function getArray(): array;

}
class DevTask implements TaskInterface
{
    private array $arr = [1,2,3];

    public function getArray(): array
    {
        return $this->arr;
    }
}
class Senior extends Handler
{
    function processing(TaskInterface $task): ?array
    {
        return $task->getArray();
    }
}
class Middle extends Handler
{
    function processing(TaskInterface $task): null
    {
        return null;
    }
}
class Jun extends Handler
{
    function processing(TaskInterface $task): null
    {
        return null;
    }
}

$task = new DevTask();
$senior = new Senior(null);
$middle = new Middle($senior);
$jun = new Jun($middle);

var_dump($jun->handle($task));