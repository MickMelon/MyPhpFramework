<?php
namespace Framework\App\Models;

use Framework\Core\Database;

class UserModel
{
    public function getAll()
    {
        return Database::query("SELECT * FROM `User`");
    }

    public function getById($id)
    {
        return Database::query("SELECT * FROM `User` WHERE `ID` = :id LIMIT 1",
            array(
                ':id' => $id,
            ));
    }
}