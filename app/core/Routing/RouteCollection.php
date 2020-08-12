<?php


namespace App\Core\Routing;


use App\Core\Http\Request;
use Exception;
use Traversable;

class RouteCollection implements \Countable, \IteratorAggregate
{
    /*
     * [
     *  GET => [
     *           Route,
     *           Route
     *           ...
     * ],
     * POST => ...
     *
     *
     */
    private $routes;

    public function __construct(array $initMethods)
    {
        $this->routes = [];

        foreach ($initMethods as $method)
        {
            $this->routes[$method] = [];
        }
    }

    public function add(Route $route)
    {
        $this->routes[$route->method()][$route->uri()] = $route;
    }

    public function match(Request $request)
    {
        $routes = $this->routes[$request->getMethod()];

        $route = $this->matchAgainstRoutes($routes, $request);

        return $route;
    }

    private function matchAgainstRoutes($routes, Request $request)
    {
        foreach ($routes as $uri => $route) {
            if ($this->matchAgainstRoute($route, $request)) {
                return $route;
            }
        }

        return null;
    }

    private function matchAgainstRoute(Route $route, Request $request)
    {
        $isMatch = preg_match('~^/'.$route->uri().'$~i', $request->baseUri());

        if($isMatch === false)
            throw new Exception('Error with a match against route and request.');

        return (bool)$isMatch;
    }

    public function count()
    {
        return \count($this->routes);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->routes);
    }

    private function all()
    {
        return $this->routes;
    }
}