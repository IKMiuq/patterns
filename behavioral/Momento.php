<?php

namespace behavioral;

/**
 * Снимок/Скриншот/Снапшот
*/

/** Класс создателя должен иметь специальный метод, который
 * сохраняет состояние создателя в новом объекте-снимке.
 */
class Momento
{
    /**
     * @var State
     */
    private State $state;

    /**
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @return void
     */
    public function printMomento(): void
    {
        var_dump($this->state);
    }
}

/** Снимок */
class State
{
    /**
     * Статус создания
     */
    public const CREATED = 'created';
    /**
     * Статус в процессе
     */
    public const PROCESS = 'process';
    /**
     * Статус тестирования
     */
    public const TEST = 'test';
    /**
     * Статус применения
     */
    public const DONE = 'done';
    /**
     * @var string
     */
    private string $state;

    /**
     * @param string $state
     */
    public function __construct(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->state;
    }
}

/**
 * Опекуном может выступать класс команд
 */
class MomentoMore
{
    /**
     * @var State
     */
    private State $state;

    /**
     * @return void
     */
    public function create():void
    {
        $this->state = new State(State::CREATED);
    }

    /**
     * @return void
     */
    public function process():void
    {
        $this->state = new State(State::PROCESS);
    }

    /**
     * @return void
     */
    public function test():void
    {
        $this->state = new State(State::TEST);
    }

    /**
     * @return void
     */
    public function done():void
    {
        $this->state = new State(State::DONE);
    }

    /**
     * @return Momento
     */
    public function saveToMomento(): Momento
    {
        return new Momento($this->state);
    }

    /**
     * @param Momento $momento
     * @return void
     */
    public function restoreFromMomento(Momento $momento):void
    {
        $this->state = $momento->getState();
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @return void
     */
    public function printMomento(): void
    {
        var_dump($this->state);
    }
}

$task = new MomentoMore();
$task->create();
$momento = $task->saveToMomento();

echo PHP_EOL.'#BEFORE#'.PHP_EOL.PHP_EOL;
$task->printMomento();
$momento->printMomento();
var_dump($task->getState() === $momento->getState());
$task->done();

echo PHP_EOL.'#AFTER#'.PHP_EOL.PHP_EOL;
$task->printMomento();
$momento->printMomento();
var_dump($task->getState() === $momento->getState());
$task->test();

echo PHP_EOL.'#AFTER#'.PHP_EOL.PHP_EOL;
$task->printMomento();
$momento->printMomento();
var_dump($task->getState() === $momento->getState());