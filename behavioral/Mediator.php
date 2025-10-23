<?php
namespace behavioral;

interface Mediator
{
    public function getWorker(Worker $sender, string $event): void;
}

abstract class Worker
{
    protected Mediator $mediator;
    public string $name;

    /**
     * @param Mediator $mediator
     */
    public function __construct(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

    public function sayHello()
    {
        $this->mediator->getWorker($this, 'hello');
    }
    public function work()
    {
        $this->mediator->getWorker($this, 'print');
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
class InfoBase
{
    public function printInfoDeveloper(string $text)
    {
        printf('Developer');
        printf($text.PHP_EOL);
    }
    public function printInfoDesigner(string $text)
    {
        printf('Designer');
        printf($text.PHP_EOL);
    }
}
class WorkerInfoBaseMediator implements Mediator
{
    private InfoBase $print;

    /**
     * @param InfoBase $print
     */
    public function __construct()
    {
        $this->print = new InfoBase();
    }

    /**
     * @param $sender
     * @param $event
     * @return void
     */
    public function getWorker($sender, $event): void
    {
        if ($event == 'print') {
            if (get_class($sender) == 'behavioral\Developer') {
                $this->print->printInfoDeveloper(' зовут ' . $sender->name);
            } else {
                $this->print->printInfoDesigner(' зовут ' . $sender->name);
            }
        } elseif ($event == 'hello') {
            if (get_class($sender) == 'behavioral\Developer') {
                $this->print->printInfoDeveloper(', ' . $sender->name.', привет! Легких релизов!');
            } else {
                $this->print->printInfoDesigner(', ' . $sender->name.', привет! Вдохновляющих котиков!');
            }
        }
    }

}

class Developer extends Worker
{

}

class Designer extends Worker
{

}

$mediator = new WorkerInfoBaseMediator();
$developer = new Developer($mediator);
$designer = new Designer($mediator);
$developer->setName('Boris');
$designer->setName('Anna');

$developer->sayHello();
$designer->sayHello();