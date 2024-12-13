<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController
{
    // This is a property that is EXPECTING to be an instance of the class TemplateEngine in a variable called view

    public function __construct(private TemplateEngine $view)
    // This instantiates the Home controller with setting the private property, view, as a new instance of TemplateEngine class
    {
    }

    public function home()
    {
        echo $this->view->render(
            "/index.php" ,
            [
                "title" => "eTracker"
            ]
        );
    } 
}

