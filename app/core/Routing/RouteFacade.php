<?php

namespace App\Core\Routing;

class  RouteFacade
{
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    private const METHOD_PUT = 'PUT';
    private const METHOD_PATCH = 'PATCH';
    private const METHOD_DELETE = 'DELETE';

    private static $router;

    public static function initialize(Router $router)
    {
        self::$router = $router;
    }

    public static function get(string $uri, string $action)
    {
        self::resolveAddRoute(self::METHOD_GET, $uri, $action);
    }

    public static function post(string $uri, string $action)
    {
        self::resolveAddRoute(self::METHOD_POST, $uri, $action);
    }

    private static function resolveAddRoute(string $method, string $uri, string $action)
    {
        self::$router->addRoute($method, $uri, $action);
    }
}