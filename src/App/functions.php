<?php

function dd(mixed $input) 
{
    echo "<pre>";
    var_dump($input);
    echo "</pre>";
    die();
}

function e(mixed $value) : string
{
    return htmlspecialchars((string) $value);
}

