<?php

namespace App\Http\Middleware;

use App\Core\Http\Request;
use App\Services\VerifyCsrfService;

class VerifyCsrfToken
{
    public function handle(Request $request, \Closure $next)
    {
        if ($request->getMethod() === 'POST') {
            if (!$this->checkCsrfField($request)) {
                throw new \Exception('Csrf-token not found');
            }
        };

        $next($request);
    }

    private function checkCsrfField(Request $request)
    {
        return VerifyCsrfService::tokenIsValid($this->getTokenFromRequest($request));
    }

    private function getTokenFromRequest(Request $request)
    {
        return $request->get('_csrf');
    }
}