<?php

namespace behavioral;

interface State
{
    public function toNext(Deal $Deal);
    public function getStatus();

}

class Deal
{
    private State $state;

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public static function make(): Deal
    {
        $self = new self();
        $self->setState(new Created());
        return $self;
    }

    public function proceedToNext()
    {
        $this->state->toNext($this);
    }
}
class Created implements State
{

    public function getStatus()
    {
        return 'Created';
    }

    public function toNext(Deal $Deal)
    {
        $Deal->setState(new Process());
    }
}
class Process implements State
{

    public function getStatus()
    {
        return 'Process';
    }

    public function toNext(Deal $Deal)
    {
        $Deal->setState(new Test());
    }
}
class Test implements State
{

    public function getStatus()
    {
        return 'Test';
    }

    public function toNext(Deal $Deal)
    {
        $Deal->setState(new Done());
    }
}
class Done implements State
{
    public function getStatus()
    {
        return 'Done';
    }

    public function toNext(Deal $Deal)
    {

    }

}

$Deal = Deal::make();
$Deal->proceedToNext();
$Deal->proceedToNext();
var_dump($Deal->getState()->getStatus());