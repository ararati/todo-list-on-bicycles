<?php

namespace App\Core\Http;

use App\Core\Application;

class HttpKernel
{

    private $app;

    protected $webMiddleware = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request)
    {
        try {
            $this->sendRequestThroughRouter($request);
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }

    public function sendRequestThroughRouter(Request $request)
    {
        $this->app->instance('request', $request);

        $this->runMiddlewares($this->webMiddleware);
    }

    public function runMiddlewares($pipes = [])
    {
        $reduceResult = array_reduce(array_reverse($pipes), $this->carry(), $this->processRequestByRouter());

        return $reduceResult($this->app->make('request'));
    }

    public function processRequestByRouter() {
        return function($request) {
            $response = $this->app->router()->processRequest($request);
            $this->resolveResponse($response);
        };
    }

    public function resolveResponse(\Closure $response)
    {
        $request = $this->app->make('request');
        $response($request);
    }

    public function carry()
    {
        return function ($stack, $pipe) {
            return function($passable) use ($stack, $pipe) {
                if(is_callable($pipe)) {
                    return $pipe($passable, $stack);
                } elseif(!is_object($pipe)) {
                    $pipe = $this->app->make($pipe);
                }

                return method_exists($pipe, 'handle')
                    ? $pipe->handle($passable, $stack)
                    : $pipe($passable, $stack);
            };
        };
    }

    public function renderException(\Exception $e)
    {
        echo '<h2>Oops...</h2>';
        echo $e->getMessage().'<hr>';
        echo 'In: '.$e->getFile().'<br>';
        echo 'At line: '.$e->getLine();
    }

}