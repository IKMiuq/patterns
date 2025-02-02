<?php

namespace behavioral;

interface Specification
{
    public function isNormal(Pupil $pupil): bool;
}
class Pupil
{
    private int $rate = 0;

    /**
     * @param int $rate
     */
    public function __construct(int $rate)
    {
        $this->rate = $rate;
    }

    public function getRate(): int
    {
        return $this->rate;
    }
}
class PupilSpecification implements Specification
{
    private int $needRate = 0;

    /**
     * @param int $needRate
     */
    public function __construct(int $needRate)
    {
        $this->needRate = $needRate;
    }

    public function isNormal(Pupil $pupil): bool
    {
        return $this->needRate < $pupil->getRate();
    }
}
class AndSpecification implements Specification
{
    private array $specification;

    /**
     * @param array $specification
     */
    public function __construct(Specification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification) {
            if ($specification->isNormal($pupil)) {
                return false;
            }
        }
        return true;
    }
}
class OrSpecification implements Specification
{
    private array $specification;

    /**
     * @param array $specification
     */
    public function __construct(Specification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification) {
            if ($specification->isNormal($pupil)) {
                return true;
            }
        }
        return false;
    }
}

class NotSpecification implements Specification
{
    private Specification $specification;

    /**
     * @param Specification $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        return  !$this->specification->isNormal($pupil);
    }
}

$spec1 = new PupilSpecification(5);
$spec2 = new PupilSpecification(10);

$pupil = new Pupil(8);

var_dump($spec1->isNormal($pupil));
var_dump($spec2->isNormal($pupil));

$andSpec = new AndSpecification($spec1, $spec2);
var_dump($andSpec->isNormal($pupil));

$orSpec = new OrSpecification($spec1, $spec2);
var_dump($orSpec->isNormal($pupil));

$notSpec1 = new NotSpecification($spec1);
$notSpec2 = new NotSpecification($spec2);
var_dump($notSpec1->isNormal($pupil));
var_dump($notSpec2->isNormal($pupil));