<?php

namespace App\Core\Http;

class Session
{
    public static function start()
    {
        session_start();
    }

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return self::has($key) ? $_SESSION[$key] : null;
    }

    public static function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }
}