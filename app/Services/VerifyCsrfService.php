<?php

namespace App\Services;

use App\Core\Http\Session;

class VerifyCsrfService
{
    /*
     * I don't have time to store data in the database
     */

    private const CSRF_TOKEN = 'DCXDCXdC782AlgXNpEt4l1VdC782AlgDCXdC782AlgXNpEt4l1VXNpEt4l1V';

    public static function tokenIsValid($token)
    {
        return $token === self::CSRF_TOKEN;
    }

    public static function getToken()
    {
        return self::CSRF_TOKEN;
    }
}