<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

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

/**
 * Dispatches a request to the appropriate controller method based on the given path and HTTP method.
 *
 * @param string $path The requested URL path (e.g., '/home').
 * @param string $method The HTTP method of the request (e.g., 'GET', 'POST').
 * @param Container|null $container (Optional) A dependency injection container for resolving classes.
 * 
 * This function matches the incoming path and method to a predefined route. 
 * If a match is found, it instantiates the associated controller and calls the specified method, 
 * optionally using the container for dependency injection.
 */
public function dispatch(string $path, string $method, Container $container = null)
{
    // Normalize the provided path (e.g., remove trailing slashes) for consistent matching.
    $path = $this->normalizePath($path);

    // Convert the HTTP method to uppercase for case-insensitive comparison (e.g., 'get' -> 'GET').
    $method = strtoupper($method);

    // Iterate over all defined routes to find a match.
    foreach ($this->routes as $route)
    {
        // Check if the current route matches the incoming path and HTTP method.
        // - `preg_match` ensures the route's path pattern matches the given path.
        // - `!==` ensures the route's method matches the given method.
        if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method)
        {
            continue; // If no match, skip to the next route.
        }

        // Extract the class and method names from the matching route's controller definition.
        // The `controller` key is expected to contain an array like: ['ClassName', 'methodName'].
        [$class, $function] = $route['controller'];

        // Determine how to instantiate the controller class:
        // - If a `Container` is provided, use it to resolve dependencies for the class.
        // - Otherwise, create a new instance of the class directly.
        $controllerClassInstance = $container ? 
            $container->resolve($class) : 
            new $class;

        // Call the specified method on the instantiated controller class.
        // This executes the desired logic for the matching route.
        $action =  fn() => $controllerClassInstance->{$function}();

        foreach ($this->middlewares as $middleware)
        {
            $middlewareInstance = $container ? 
                $container->resolve($middleware) : 
                new $middleware;
            $action = fn() => $middlewareInstance->process($action);
        }

        $action();

        return;
    }
}


    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}