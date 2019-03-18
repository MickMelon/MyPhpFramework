<?php
namespace Core\Util;

/**
 * A wrapper around the cookie functions.
 */
class Cookie
{
    /**
     * Gets a cookie variable by its key.
     *
     * @param string $key The cookie variable key.
     * @return value
     */
    public static function get(string $key)
    {
        return $_COOKIE[$key];
    }

    /**
     * Sets a cookie.
     *
     * @param string $key The key.
     * @param any $value The value
     * @param integer $expiry The expiry.
     * @return boolean
     */
    public static function set(string $key, $value, int $expiry)
    {
        return setcookie($key, $value, time() + $expiry, "/");
    }

    /**
     * Checks if a value exists for the given key.
     *
     * @param string $key The cookie variable key.
     * @return boolean Whether the value exists.
     */
    public static function exists(string $key)
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * Deletes a cookie value.
     *
     * @param string $key The cookie variable key.
     * @return void
     */
    public static function delete(string $key)
    {
        self::put($key, "", time() - 1);
    }
}