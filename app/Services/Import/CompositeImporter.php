<?php

namespace App\Services\Import;

class CompositeImporter implements ImportStrategy
{
    /** @var iterable|ImportStrategy[] */
    private iterable $importers;

    /**
     * @param iterable $importers
     */
    public function __construct(iterable $importers)
    {
        $this->importers = $importers;
    }

    public function support(string $type): bool
    {
        return $type === 'all';   // TODO: Implement support() method.
    }

    public function import(): void
    {
        foreach ($this->importers as $importer) {
            $importer->import();
        }
    }
}
