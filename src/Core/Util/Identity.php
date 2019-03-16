<?php
namespace Core\Util;

use App\Models\DataAccess;

use Core\Util\Session;
use Core\Util\Password;

/**
 * Undocumented class
 */
class Identity
{
    /**
     * Undocumented function
     *
     * @param [type] $email
     * @param [type] $password
     * @return void
     */
    public static function login(string $email, string $password)
    {
        $dataAccess = DataAccess::getInstance();

        $user = $dataAccess->users()->getByEmail($email);
        if (!$user || !Password::verify($password, $user->Password)) return false;

        Session::set('user', $user);
        return true;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function logout()
    {
        if (self::isLoggedIn()) Session::delete('user');
    }

    /**
     * Undocumented function
     *
     * @param [type] $email
     * @param [type] $password
     * @param [type] $name
     * @return void
     */
    public static function register(string $email, string $password, string $name)
    {
        $dataAccess = DataAccess::getInstance();

        $existingUser = $dataAccess->users()->getByEmail($email);
        if ($existingUser) return false;

        $hash = Password::hash($password);
        $dataAccess->users()->create($email, $hash, $name);
        return true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public static function isLoggedIn()
    {
        return Session::exists('user');
    }
}