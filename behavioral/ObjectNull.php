<?php

namespace behavioral;

interface Worker
{
    public function work();

}
class ObjectManager
{
    private Worker $worker;

    /**
     * @param Worker $worker
     */
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    public function goWork()
    {
        $this->worker->work();
    }
}

class Developer implements Worker
{
    public function work(): void
    {
        printf('Developer is working');
    }

}
class NullWorker implements Worker
{
    public function work()
    {

    }
}

$developer = new Developer();
$nullable = new NullWorker();

$objectManager = new ObjectManager($developer);
$objectManager->goWork();
$objectManager = new ObjectManager($nullable);
$objectManager->goWork();