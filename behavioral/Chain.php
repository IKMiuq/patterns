<?php

namespace behavioral;

use structural\Service;

/**
 *
 */
abstract class Handler
{
    /**
     * @var Handler|null
     */
    private ?Handler $successor;

    /**
     * @param Handler|null $successor
     */
    public function __construct(?Handler $successor)
    {
        $this->successor = $successor;
    }

    /**
     * @param TaskInterface $task
     * @return array|null
     */
    final public function handle(TaskInterface $task)
    {
        $procesed = $this->processing($task);
        if ($procesed === null && $this->successor) {
            $procesed = $this->successor->handle($task);
        }
        return $procesed;
    }

    /**
     * @param TaskInterface $task
     * @return array|null
     */
    abstract function processing(TaskInterface $task): ?array;
}

/**
 *
 */
interface TaskInterface
{
    /**
     * @return array
     */
    public function getArray(): array;

}

/**
 *
 */
class DevTask implements TaskInterface
{
    /**
     * @var array|int[]
     */
    private array $arr = [1,2,3];

    /**
     * @return array|int[]
     */
    public function getArray(): array
    {
        return $this->arr;
    }
}

/**
 *
 */
class Senior extends Handler
{
    /**
     * @param TaskInterface $task
     * @return array|null
     */
    function processing(TaskInterface $task): ?array
    {
        return $task->getArray();
    }
}

/**
 *
 */
class Middle extends Handler
{
    /**
     * @param TaskInterface $task
     * @return null
     */
    function processing(TaskInterface $task): null
    {
        return null;
    }
}

/**
 *
 */
class Jun extends Handler
{
    /**
     * @param TaskInterface $task
     * @return null
     */
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