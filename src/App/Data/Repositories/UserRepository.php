<?php
namespace App\Data\Repositories;

use App\Data\Repositories\Interfaces\IUserRepository;
use App\Models\User;

use Core\PdoDatabase;

class UserRepository implements IUserRepository
{
    private $database;

    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $dbResult = $this->database->query("SELECT * FROM `User`");

        $users = array();

        foreach ($dbResult as $result)
        {
            $users[] = User::makeFromData($result);
        }

        return $users;
    }

    public function getById(int $id)
    {
        $dbResult = $this->database->query("SELECT * FROM `User` WHERE `ID` = :id LIMIT 1",
            array(
                ':id' => $id,
            ));

        if (!$dbResult) return false;

        return User::makeFromData($dbResult);
    }

    public function getByEmail(string $email)
    {
        $dbResult = $this->database->query("SELECT * FROM `User` WHERE `Email` = :email LIMIT 1",
            array(
                ':email' => $email,
            ));

        if (!$dbResult) return false;

        $user = new User($dbResult);
        return $user;
    }

    public function add(User $user)
    {
        $this->database->query("INSERT INTO `User`"
            . " (`FirstName`, `LastName`, `Gender`, `Email`, `Password`, `CmgRating`, `Handicap`,"
            . " `Created`, `LastModified`)"
            . " VALUES (:firstName, :lastName, :gender, :email, :password, :cmgRating, :handicap,"
            . " :created, :lastModified)",
            array(
                ':firstName' => $user->getFirstName(),
                ':lastName' => $user->getLastName(),
                ':gender' => $user->getGender(),
                ':email' => $user->getEmail(),
                ':password' => $user->getPassword(),
                ':cmgRating' => $user->getCmgRating(),
                ':handicap' => $user->getHandicap(),
                ':created' => $user->getCreated(),
                ':lastModified' => $user->getLastModified()
            ));
    }

    public function update(User $user)
    {
        $this->database->query("UPDATE `User` SET"
            . " `FirstName` = :firstName,"
            . " `LastName` = :lastName,"
            . " `Gender` = :gender,"
            . " `Email` = :email,"
            . " `Password` = :password,"
            . " `CmgRating` = :cmgRating,"
            . " `Handicap` = :handicap,"
            . " `Created` = :created,"
            . " `LastModified` = :lastModified"
            . " WHERE `ID` = :id LIMIT 1",
            array(
                ':firstName' => $user->getFirstName(),
                ':lastName' => $user->getLastName(),
                ':gender' => $user->getGender(),
                ':email' => $user->getEmail(),
                ':password' => $user->getPassword(),
                ':cmgRating' => $user->getCmgRating(),
                ':handicap' => $user->getHandicap(),
                ':created' => $user->getCreated(),
                ':lastModified' => $user->getLastModified(),
                ':id' => $user->getId()
            ));
    }

    public function remove(User $user)
    {
        $this->database->query("DELETE FROM `User` WHERE `ID` = :id LIMIT 1",
            array(
                ":id" => $user->getId()
            ));
    }
}