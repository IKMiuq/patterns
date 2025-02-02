<?php

namespace behavioral;

class Momento
{
    private State $state;

    /**
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function getState(): State
    {
        return $this->state;
    }
}
class State
{
    public const CREATED = 'created';
    public const PROCESS = 'process';
    public const TEST = 'test';
    public const DONE = 'done';
    private string $state;

    /**
     * @param string $state
     */
    public function __construct(string $state)
    {
        $this->state = $state;
    }

    public function __toString(): string
    {
        return $this->state;
    }


}
class MomentoMore
{
    private State $state;
    public function create()
    {
        $this->state = new State(State::CREATED);
    }
    public function process()
    {
        $this->state = new State(State::PROCESS);
    }
    public function test()
    {
        $this->state = new State(State::TEST);
    }
    public function done()
    {
        $this->state = new State(State::DONE);
    }

    public function saveToMomento(): Momento
    {
        return new Momento($this->state);
    }

    public function restoreFromMomento(Momento $momento)
    {
        $this->state = $momento->getState();
    }
    public function getState(): State
    {
        return $this->state;
    }

}

$task = new MomentoMore();
$task->create();
$momento = $task->saveToMomento();
var_dump($task->getState() === $momento->getState());