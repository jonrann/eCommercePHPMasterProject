<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\paths;


class AboutController
{   
    public function __construct(private TemplateEngine $view)
    // This instantiates the Home controller with setting the private property, view, as a new instance of TemplateEngine class
    {

    }

    public function about()
    {
        echo $this->view->render("/about.php" ,
            [
            'title' => 'About',
            'dangerousData' => '<script>alert(123)</script>'
            ]
        );
    } 
}