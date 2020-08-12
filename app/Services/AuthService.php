<?php

namespace App\Services;

use App\Core\Http\Session;

class AuthService
{
    /*
     * I don't have time to store data in the database
     */
//    private const AUTH_USERNAME = 'admin';
//    private const AUTH_PASSWORD = '123';

    private const SESSION_KEY = 'auth';
    private const SESSION_HASH = '3f1af54273e4df8b70a9cf89f6b694eceb58ab4dc7afafa657813b8df985d845';
    private const SECRET_SALT = 'MnEqnaCmDYqcGhAOJx3f';

    public static function login($name, $password)
    {

        // Todo: Refactoring
        if(self::credentialIsValid($name, $password))
        {
            \App\Core\Http\Session::set(self::SESSION_KEY, self::SESSION_HASH);
        }
    }

    public static function credentialIsValid($name, $password) {
        return self::generateHash($name, $password) === self::SESSION_HASH;
    }

    public static function hashIsValid($hash)
    {
        return $hash === self::SESSION_HASH;
    }

    public static function logout()
    {
        Session::set(self::SESSION_KEY, '');
    }

    private static function generateHash($username, $password)
    {
        return hash('sha256', $username.$password.self::SECRET_SALT);
    }
}