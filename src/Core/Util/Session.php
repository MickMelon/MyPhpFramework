<?php
namespace Core\Util;

class Session
{
    /**
     * Initializes the session.
     *
     * @return void
     */
    public static function init()
    {
        if (!isset($_SESSION))
        {
            if (PHP_SAPI === 'cli') 
            {
                $_SESSION = array();
            }
            else if (!headers_sent()) 
            {
                if (!session_start()) 
                {
                    throw new Exception(__METHOD__ . ' session_start failed.');
                }
            }                
            else 
            {
                throw new Exception(__METHOD__ . ' session started after headers sent.');
            }
        }
    }

    /**
     * Sets a session value.
     *
     * @param string $key The session variable key.
     * @param object $value
     * @return void
     */
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = serialize($value);
    }

    /**
     * Gets a session value.
     *
     * @param string $key The session variable key.
     * @return object The session value.
     */
    public static function get(string $key)
    {
        if (self::exists($key))
            return unserialize($_SESSION[$key]);
    }

    /**
     * Deletes a session value if it exists.
     *
     * @param string $key The session variable key.
     * @return void
     */
    public static function delete(string $key)
    {  
        if (self::exists($key))
            unset($_SESSION[$key]);
    }

    /**
     * Checks if the specified key exists in the session array.
     *
     * @param string $key The session variable key.
     * @return boolean Whether the key exists.
     */
    public static function exists(string $key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Destroys the session.
     *
     * @return void
     */
    public static function destroy()
    {
        if (!PHP_SAPI === 'cli')
            session_destroy();
    }

    public static function isLoggedIn()
    {
        return self::exists('User');
    }
}