<?php

namespace App\Services\Import;

class ImporterContext
{
    /** @var iterable|ImportStrategy[] */
    private iterable $strategies;

    /**
     * @param iterable $strategies
     */
    public function __construct(iterable $strategies)
    {
        $this->strategies = $strategies;
    }

    public function import(string $type): void
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->support($type)) {
                $strategy->import();

                return;
            }
        }

        throw new \Exception('Invalid strategy type provided');
    }
}
