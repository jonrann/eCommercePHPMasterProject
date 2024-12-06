<?php

declare(strict_types=1);

namespace Framework;

class Container
{
    private array $definitions = [];

    public function addDefinitions(array $newDefinitions)
    {
        // ... operator unpacks an array
        $this->definitions = [...$this->definitions, ...$newDefinitions];

        dd($newDefinitions);
    }
}