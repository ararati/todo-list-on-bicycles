<?php

namespace App\Http\Validation;

use App\Core\Http\Request;
use App\Core\Http\Validation\Validation;
use App\Services\AuthService;

class AuthValidation extends Validation
{
    private const ERROR_AUTH_MESSAGE = 'Credentials not found. Please check your username or password.';

    public function check(Request $request)
    {
        $name = $request->get('username');
        $password = $request->get('password');

        $this->checkValue($name)->min(3)->max(100);
        $this->checkValue($password)->min(3)->max(100);

        $isValid = AuthService::credentialIsValid($name, $password);
        parent::handle($isValid, self::ERROR_AUTH_MESSAGE);
    }
}