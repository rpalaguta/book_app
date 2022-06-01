<?php

namespace App\Services\Import;

interface ImportStrategy
{
    public function import(): void;

    public function support(string $type): bool;
}
