<?php
namespace App\Models;

use Core\IDataAccess;

class DataAccess implements IDataAccess
{
    private static $instance;

    private $userModel;

    private function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function users()
    {
        return $this->userModel;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::setInstance();
        }

        return self::$instance;
    }

    private static function setInstance()
    {
        $userModel = new UserModel();
        self::$instance = new DataAccess($userModel);
    }
}