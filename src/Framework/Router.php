<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];

    private function normalizePath(string $path): string
    // used to normalize path names
    {
        $path = trim($path, '/');
        $path = "/$path/";
        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    public function add(string $method, string $path, array $controller)
    // Formatting path to have forward slashes before and after path name for consistency
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route)
        {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method)
            {
                continue;
            }

            // We are grabbing the route's class and method we found a matching path with and storing them into an array (It's like destructiong them into variables inside an array)
            // First item is always Class name and second item is always Method name
            // Use dd($route) to see contents
            [$class, $function] = $route['controller'];

            // Create new instance of class and invoke method of class through these variables
            // Checking the container value, if so, execute code to the right of the ternary operator (?)
                // container's resolve function is called if $container has a value
            $controllerClassInstance = $container ? 
                $container->resolve($class) : 
                new $class;
            
            $controllerClassInstance->{$function}();
        }
    } 
}