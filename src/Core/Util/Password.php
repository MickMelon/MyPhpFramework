<?php
namespace Core\Util;

class Password
{
    public static function hash($textPassword)
    {
        return hash_password($textPassword);
    }

    public static function verify($textPassword, $hashPassword)
    {
        return password_verify($textPassword, $hashPassword);
    }
}