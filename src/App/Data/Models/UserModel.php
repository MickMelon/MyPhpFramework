<?php
namespace Framework\App\Models;

use Framework\Core\BaseModel;

class UserModel extends BaseModel
{
    public function getAllUsers()
    {
        $sql = "SELECT * FROM `User`";
        $query = $this->database()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllUsers2()
    {
        return $this->query("SELECT * FROM `User`");
    }

    public function getById($id)
    {
        return $this->query("SELECT * FROM `User` WHERE `ID` = :id LIMIT 1",
            array(
                ':id' => $id,
            ));
    }
}