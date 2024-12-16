<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ValidatorService;
use App\Config\paths;

class RegisterController
{
    public function __construct
        (
        private TemplateEngine $view,
        private ValidatorService $validatorService
    )
    {
    }

    public function register()
    {
        echo $this->view->render(
            "/register.php", 
            ["title" => "Register"]
        );
    }

    public function registerPost()
    {
        $this->validatorService->validateRegister($_POST);
    }
}