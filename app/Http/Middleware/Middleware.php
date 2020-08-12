<?php

namespace App\Http\Middleware;

class Middleware extends \App\Core\Http\HttpKernel
{
    protected $webMiddleware = [
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];
}