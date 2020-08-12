<?php


namespace App\Core\Routing;


class Route
{
    protected $uri;

    protected $method;

    protected $action;

    protected $controller;

    public function __construct(string $method, string $uri, $action)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->action = $action;
    }

    public function method()
    {
        return $this->method;
    }

    public function uri()
    {
        return $this->uri;
    }

    public function action()
    {
        return $this->action;
    }

    public function controller()
    {
        return $this->controller;
    }
}