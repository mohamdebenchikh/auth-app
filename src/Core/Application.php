<?php

namespace App\Core;

class Application
{
    protected array $routes = [];                 // Array to store registered routes
    protected array $initialMiddleware = [];     // Array to store initial middleware
    protected array $groupMiddleware = [];       // Array to store group middleware

    /**
     * Register a GET route.
     *
     * @param string $path
     * @param mixed $callback
     * @return Route
     */
    public function get(string $path, $callback)
    {
        return $this->addRoute('GET', $path, $callback);
    }

    /**
     * Register a POST route.
     *
     * @param string $path
     * @param mixed $callback
     * @return Route
     */
    public function post(string $path, $callback)
    {
        return $this->addRoute('POST', $path, $callback);
    }

    /**
     * Register middleware for all routes.
     *
     * @param mixed $middleware
     * @return $this
     */
    public function middleware($middleware)
    {
        $this->initialMiddleware[] = $middleware;
        return $this;
    }

    /**
     * Create a route group with shared middleware.
     *
     * @param array $options
     * @param callable $callback
     */
    public function group(array $options, $callback)
    {
        $middleware = $options['middleware'] ?? null;

        if ($middleware !== null) {
            $this->groupMiddleware = is_array($middleware) ? $middleware : [$middleware];
        }

        $callback($this);
        $this->groupMiddleware = [];
    }

    /**
     * Add a route to the registered routes array.
     *
     * @param string $method
     * @param string $path
     * @param mixed $callback
     * @return Route
     */
    protected function addRoute(string $method, string $path, $callback)
    {
        $route = new Route($path, $callback);
        if (!empty($this->groupMiddleware)) {
            $route->middleware($this->groupMiddleware);
        }
        $this->routes[$method][] = $route;
        return $route;
    }

    /**
     * Handle incoming requests and execute matching routes.
     */
    public function run()
    {
        $request = new Request();
        $path = $request->path();
        $method = $request->method();

        $middlewares = $this->initialMiddleware;

        $next = function ($request) use (&$middlewares, $path, $method, &$next) {
            if (!empty($middlewares)) {
                $middleware = array_shift($middlewares);
                $middlewareInstance = new $middleware();
                return $middlewareInstance->handle($request, $next);
            }

            // If no middleware is left, process the routes
            foreach ($this->routes[$method] ?? [] as $route) {
                if ($route->match($path)) {
                    $result = $route->execute($request);

                    if ($result instanceof Redirect) {
                        return $result->execute();
                    }

                    $response = new Response($result, 200, ['Content-Type' => 'text/html; charset=utf-8']);
                    $response->send();
                    die();
                }
            }

            // If no route matches, handle 404 Not Found
            $errorPage = (new View())->render('errors/404');
            $response = new Response($errorPage, 404, ['Content-Type' => 'text/html; charset=utf-8']);
            $response->send();
            die();
        };

        $next($request);
    }
}
