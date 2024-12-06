<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\paths;


class AboutController
{
    private TemplateEngine $view;

    public function __construct()
    // This instantiates the Home controller with setting the private property, view, as a new instance of TemplateEngine class
    {
        $this->view = new TemplateEngine(PATHS::VIEW);
    }

    public function about()
    {
        echo $this->view->render("/about.php" ,[
            'title' => 'About',
            'dangerousData' => '<script>alert(123)</script>'
        ]);
    } 
}