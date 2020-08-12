<?php

namespace App\Http\Controllers;

use App\Core\Http\Request;
use App\Http\Validation\AuthValidation;
use App\Http\Validation\LogoutValidation;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authValidation;

    private $logoutValidation;

    public function __construct()
    {
        $this->baseTemplate = 'layouts/app';

        $this->authValidation = new AuthValidation();
        $this->logoutValidation = new LogoutValidation();
    }


    public function index(Request $request)
    {
        $this->view('auth/index');
    }

    public function auth(Request $request)
    {
        $this->authValidation->check($request);

        AuthService::login($request->get('username'), $request->get('password'));

        $this->redirect();
    }

    public function logout(Request $request)
    {
        $this->logoutValidation->check($request);

        AuthService::logout();

        $this->redirect();
    }
}