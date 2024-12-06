<?php

declare(strict_types=1);

use Framework\TemplateEngine;
// This is imported so we can access the path to the views directory for the TemplateEngine class
use App\Config\Paths;

// We can access the instructions of creating instances from this dictionary (associative array)
return [
    // This is instantiating a new instance of the TemplateEngine class by storing it within the key called "TemplateEngine"
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW)
];
