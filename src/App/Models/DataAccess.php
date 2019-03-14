<?php
namespace Framework\App\Models;

class DataAccess
{
    private static $instance;

    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function users()
    {
        return $this->userModel;
    }

    public static function make()
    {
        if (!isset(self::$instance))
        {
            $userModel = new UserModel();
            self::$instance = new DataAccess($userModel);
        }

        return self::$instance;
    }
}