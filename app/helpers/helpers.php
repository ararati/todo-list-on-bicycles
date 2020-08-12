<?php

function request()
{
    global $app;

    return $app->make('request');
}

function isAuth()
{
    global $app;

    $hash = \App\Core\Http\Session::get('auth');

    return \App\Services\AuthService::hashIsValid($hash);
}

/**
 * Escaping input values
 *
 * @param string
 *
 * @return string escaped data
 */
function s($value)
{
    return htmlspecialchars($value);
}

function buildQuery(array $paramValues)
{
    return request()->baseUri() . '?' . http_build_query($paramValues);
}

function csrfField()
{
    $token = \App\Services\VerifyCsrfService::getToken();

    return "<input type = 'hidden' name = '_csrf' value = " . $token . ">";
}