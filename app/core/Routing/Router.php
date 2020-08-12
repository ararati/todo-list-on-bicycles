<?php

namespace App\Core\Routing;

use App\Core\Application;
use App\Core\Http\Request;

class Router
{

    protected const ACTION_DELIMETER = ':';

    private $request;

    private $routes;

    private $container;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->routes = new RouteCollection(Request::allowedMethods());
    }

    public function setContainer(Application $container)
    {
        $this->container = $container;
    }

    public function addRoute(string $method, string $uri, string $action)
    {
        $route = new Route($method, $uri, $action);
        $this->routes->add($route);
    }

    public function processRequest(Request $request)
    {
        $this->request = $request;

        return $this->resolveRequest($request);
    }

    private function resolveRequest(Request $request)
    {
        return $this->dispatchToRoute($request);
    }

    private function dispatchToRoute(Request $request)
    {
        return $this->runRoute($request, $this->findRoute($request));
    }

    private function runRoute(Request $request, Route $route)
    {
        return $this->resolveRouteAction($route);
    }

    private function findRoute(Request $request)
    {
        $route = $this->routes->match($request);

        if(is_null($route))
            throw new \Exception('Route for request not found');

        return  $route;
    }

    private function resolveRouteAction(Route $route)
    {
        $action = $route->action();

        return is_callable($action) ? $action : $this->resolveControllerAction($action);
//        if(is_callable($action)) {
//            return $action;
//        } else {
//            return $this->resolveControllerAction($action);
//        }
    }

    private function splitControllerAction(string $action)
    {
        return explode(self::ACTION_DELIMETER, $action);
    }

    private function resolveControllerAction(string $action)
    {
        [$controllerStr, $actionStr] = $this->splitControllerAction($action);

        $controller = $this->container->makeController($controllerStr);

        if(method_exists($controller, $actionStr)) {
            return function($request) use($controller, $actionStr) {
                $controller->$actionStr($request);
            };
        }

        throw new \Exception("Method [$actionStr] in controller [$controllerStr] does not exists.");
    }
}