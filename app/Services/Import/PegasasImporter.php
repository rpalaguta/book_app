<?php

namespace App\Services\Import;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Services\Import\ImportStrategy;

class PegasasImporter implements ImportStrategy
{
    public function support(string $type): bool
    {
        return $type === 'pegasas';
    }

    public function import(): void
    {
        echo "Not implemented yet";
    }
}
