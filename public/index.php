<?php

include __DIR__ . "/../src/App/functions.php";

$app = include __DIR__ . "/../src/App/bootstrap.php";


// For learning purposes and understanding flow of code:
/**
 * run()->
 *  Path and Method is grabbed from URL in browser so dispatch knows what controller to grab
 *  dispatch()->
 *      homeController->home()
 */
$app->run();

