<?php
namespace Core\Util;

/**
 * Encapsulates the password hashing and verification to accomodate for potential
 * changes in the algorithm in the future.
 */
class Password
{
    /**
     * Hashes the given text.
     *
     * @param string $textPassword The password in plain-text.
     * @return string The hashed password.
     */
    public static function hash($textPassword)
    {
        return hash_password($textPassword);
    }

    /**
     * Checks if the plain-text password matches the hash.
     *
     * @param string $textPassword The plain-text password.
     * @param string $hashPassword The encrypted password hash.
     * @return boolean Whether the password matches.
     */
    public static function verify($textPassword, $hashPassword)
    {
        return password_verify($textPassword, $hashPassword);
    }
}