<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMiddlware;

function registerMiddleware(App $app)
{
    $app->addMiddleware(TemplateDataMiddlware::class);
}

