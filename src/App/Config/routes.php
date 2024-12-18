<?php

declare(strict_types=1);

namespace App\Config;


use App\Controllers\{AboutController, HomeController, RegisterController};
use Framework\App;




function registerRoutes(App $app)
{
    // Value of this constant is the class path name in a string
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [RegisterController::class, 'register']);
    $app->post('/register', [RegisterController::class, 'registerPost']);
}