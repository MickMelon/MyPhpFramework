<?php
namespace Framework\App\Data\Repositories;

use PDO;

class UserRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        return $this->database->query("SELECT * FROM `User`");
    }

    public function getById($id)
    {
        return $this->query("SELECT * FROM `User` WHERE `ID` = :id LIMIT 1",
            array(
                ':id' => $id,
            ));
    }
}