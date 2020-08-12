<?php


namespace App\Core\Http;


use Exception;
use Traversable;

class ParameterBag implements \IteratorAggregate, \Countable
{
    protected $parameters;

    public function all() {
        return $this->parameters;
    }

    public function add(array $parameters) {
        $this->parameters = array_replace($this->parameters, $parameters);
    }

    public function get(string $key)
    {
        return $this->has($key) ? $this->parameters[$key] : null;
    }

    public function set(string $key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function has(string $key)
    {
        return array_key_exists($key, $this->parameters);
    }

    public function remove(string $key)
    {
        unset($this->parameters[$key]);
    }

    public function __construct(array $request)
    {
        $this->parameters = $request;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }

    public function count()
    {
        return count($this->parameters);
    }
}