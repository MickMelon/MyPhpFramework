<?php
namespace Core\Util;

class Cookie
{
    public static function get(string $key)
    {
        return $_COOKIE[$key];
    }

    public static function set(string $key, $value, int $expiry)
    {
        return setcookie($key, $value, time() + $expiry, "/");
    }

    public static function exists(string $key)
    {
        return isset($_COOKIE[$key]);
    }

    public static function delete(string $key)
    {
        self::put($key, "", time() - 1);
    }
}