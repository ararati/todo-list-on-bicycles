<?php

namespace App\Core;

use App\Core\Routing\Router;

class Application extends Container {

    protected $router = null;

    protected const CONTROLLER_NAMESPACE = 'App\Http\Controllers';

    public function setRouter($className) {
        $concrete = $this->make($className);
        $this->instance($className, $concrete);

        $this->router = $concrete;
    }

    public function router() : Router
    {
        return $this->router;
    }

    public function makeController(string $className)
    {
        return parent::make(self::CONTROLLER_NAMESPACE.'\\'.$className);
    }
}