<?php
namespace Core\Util;

class Cookie
{
    public static function get($key)
    {
        return $_COOKIE[$key];
    }

    public static function set($key, $value, $expiry)
    {
        return setcookie($key, $value, time() + $expiry, "/");
    }

    public static function exists($key)
    {
        return isset($_COOKIE[$key]);
    }

    public static function delete($key)
    {
        self::put($key, "", time() - 1);
    }
}