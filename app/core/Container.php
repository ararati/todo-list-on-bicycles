<?php


namespace App\Core;


class Container
{

    private $instances;

    public function instance($abstract, $instance)
    {
        $this->instances[$abstract] = $instance;

        return $instance;
    }

    public function build($concrete)
    {
        try {
            $reflector = new \ReflectionClass($concrete);
        } catch (\ReflectionException $e)
        {
            throw new \Exception("Target class [$concrete] does not exist", 0, $e);
        }

        if(!$reflector->isInstantiable()) {
            throw new \Exception("Target class [$concrete] is not instantiable");
        }

        return new $concrete;
    }

    public function make($abstract)
    {
        return $this->resolve($abstract);
    }

    private function resolve($abstract)
    {
        if(isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        return $this->build($abstract);
    }

}