<?php

namespace App\Http\Controllers;

use App\Core\Http\Request;
use App\Http\Validation\AuthorizationRequiredValidation;

class Controller extends \App\Core\Http\Controller
{
    protected $authorizationValidation;

    public function __construct()
    {
        $this->authorizationValidation = new AuthorizationRequiredValidation();
    }

    public function allowOnlyAuth(Request $request)
    {
        $this->authorizationValidation->check($request);
    }
}