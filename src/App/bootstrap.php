<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Controllers\HomeController, App\Controllers\AboutController;

$app = new App();

// Value of this constant is the class path name in a string
$app->get('/', [HomeController::class, 'home']);

return $app;