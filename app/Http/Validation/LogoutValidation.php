<?php

namespace App\Http\Validation;

use App\Core\Http\Request;
use App\Core\Http\Validation\Validation;

class LogoutValidation extends Validation
{
    private const ERROR_AUTH_MESSAGE = 'Credentials not found. Please check your username or password.';

    public function check(Request $request)
    {
        $hash = \App\Core\Http\Session::get('auth');

        $isValid = \App\Services\AuthService::hashIsValid($hash);

        parent::handle($isValid, self::ERROR_AUTH_MESSAGE);
    }
}