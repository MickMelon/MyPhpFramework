<?php
namespace App\Models;

use Core\Database;

/**
 * Used for interacting with the User table.
 */
class UserModel
{
    /**
     * Get all the users from the database.
     *
     * @return array All the users.
     */
    public function getAll()
    {
        return Database::query("SELECT * FROM `User`");
    }

    /**
     * Gets a user that matches the specified ID.
     *
     * @param int $id The User ID.
     * @return object PDO User object or false if none found.
     */
    public function getById($id)
    {
        return Database::query("SELECT * FROM `User` WHERE `ID` = :id LIMIT 1",
            array(
                ':id' => $id,
            ));
    }
}