<?php

namespace DesignPatterns\Prototype;

use DesignPatterns\Prototype\Steps\End;
use DesignPatterns\Prototype\Steps\Start;

class BusinessProcessFlow
{

    private Start $start;
    private End $end;

    /** @var Step[] */
    private array $steps = [];

    public function __construct(Start $start, End $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function addStep(Step $step): void
    {
        $this->steps[] = $step;
    }

    public function run(BusinessEntity $entity): void
    {
        $this->start->execute($entity);

        foreach ($this->steps as $step) {
            $step->execute($entity);
        }

        $this->end->execute($entity);
    }

    public function __clone()
    {
        $this->start = clone $this->start;
        $this->end = clone $this->end;
        $this->steps = [];
    }
}