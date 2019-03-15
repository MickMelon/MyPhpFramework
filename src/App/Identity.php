<?php
namespace App;

use App\Models\DataAccess;
use Core\Util\Password;

class Identity
{
    private static $currentUser;

    public static function login($email, $password)
    {
        $dataAccess = DataAccess::getInstance();

        $user = $dataAccess->users()->getByEmail($email);
        if (!$user || !Password::verify($password, $user->Password)) return false;

        self::$currentUser = $user;
        return true;
    }

    public static function logout()
    {
        if (self::isLoggedIn()) self::$currentUser = null;
    }

    public static function register($email, $password, $name)
    {
        $dataAccess = DataAccess::getInstance();

        $existingUser = $dataAccess->users()->getByEmail($email);
        if ($existingUser) return false;

        $hash = Password::hash($password);
        $dataAccess->users()->create($email, $hash, $name);
        return true;
    }

    public static function isLoggedIn()
    {
        return self::$currentUser != null;
    }
}