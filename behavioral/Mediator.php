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
     * Устанавливает медиатор
     * @param Mediator $mediator
     */
    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }

    /**
     * Вызывает печать приветствия
     * return void
    */
    public function sayHello(): void
    {
        $this->mediator->getWorker($this, 'hello');
    }

    /**
     * Вызывает печать знакомства
     * return void
     */
    public function work(): void
    {
        $this->mediator->getWorker($this, 'print');
    }

    /**
     * Устанавливает имя
     * return void
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}

class InfoBase
{

    /**
     * Печатает приветствие для разработчика
     * return void
     */
    public function printInfoDeveloper(string $text): void
    {
        printf('Developer');
        printf($text.PHP_EOL);
    }

    /**
     * Печатает приветствие для дизайнера
     * return void
     */
    public function printInfoDesigner(string $text): void
    {
        printf('Designer');
        printf($text.PHP_EOL);
    }
}

class WorkerInfoBaseMediator implements Mediator
{
    private InfoBase $print;
    private Developer $developer;
    private Designer $designer;

    /**
     * @param Developer $developer
     * @param Designer $designer
     */
    public function __construct(Developer $developer, Designer $designer)
    {
        $this->print = new InfoBase();
        $this->developer = $developer;
        $this->designer = $designer;
        $this->developer->setMediator($this);
        $this->designer->setMediator($this);
    }

    /**
     * Распределяет работу в соответствии с полученным объектом
     * @param Designer|Developer $sender
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

$developer = new Developer();
$designer = new Designer();
new WorkerInfoBaseMediator($developer, $designer);
$developer->setName('Boris');
$designer->setName('Anna');

$developer->sayHello();
$designer->sayHello();