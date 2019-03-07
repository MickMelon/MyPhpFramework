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
}