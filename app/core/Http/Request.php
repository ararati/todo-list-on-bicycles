<?php

namespace App\Core\Http;

class Request
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';

    protected $request;

    protected $query;

    protected $cookies;

    protected $server;

    protected $method;

    public function __construct(array $query = [], array $request = [], array $cookies = [], array $server = [])
    {
        $this->initialize($query, $request, $cookies, $server);
    }

    public function initialize(array $query = [], array $request = [], array $cookies = [], array $server = [])
    {
        $this->request = new ParameterBag($request);
        $this->query = new ParameterBag($query);
        $this->cookies = new ParameterBag($cookies);
        $this->server = new ParameterBag($server);

        $this->method = null;
    }

    public static function createRequestFromGlobal()
    {
        return self::createRequestFromFactory($_GET, $_POST, $_COOKIE, $_SERVER);
    }

    private static function createRequestFromFactory(array $query = [], array $request = [], array $cookies = [], array $server = []): self
    {
        return new static($query, $request, $cookies, $server);
    }

    public static function capture()
    {
        return static::createRequestFromGlobal();
    }

    public function getMethod()
    {
        if (null !== $this->method)
            return $this->method;

        $this->method = $this->server->get('REQUEST_METHOD');

        return $this->method;
    }

    public function uri()
    {
        return $this->server->get('REQUEST_URI');
    }

    public function baseUri()
    {
        return strtok($this->uri(), '?');
    }

    public function explodeParams()
    {
        return explode('/', $this->uri());
    }

    public function get($key)
    {
        if ($this->request->has($key)) {
            return $this->request->get($key);
        }

        if ($this->query->has($key)) {
            return $this->query->get($key);
        }

        return null;
    }

    public function has($key)
    {
        return $this->request->has($key) || $this->query->has($key);
    }

    public function all()
    {
        return array_merge($this->request->all(), $this->query->all());
    }

    public static function isAllowedMethod(string $method)
    {
        return array_key_exists($method, self::allowedMethods());
    }

    public static function allowedMethods()
    {
        return [
            self::METHOD_POST,
            self::METHOD_GET,
            self::METHOD_DELETE,
            self::METHOD_PATCH,
            self::METHOD_PUT
        ];
    }

    public function server()
    {
        return $this->server;
    }
}