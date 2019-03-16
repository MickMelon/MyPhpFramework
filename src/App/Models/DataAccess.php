<?php
namespace App\Models;

use Core\IDataAccess;

/**
 * Contains all the models to access the database.
 */
class DataAccess implements IDataAccess
{
    /**
     * The instance of the DataAccess class.
     *
     * @var DataAccess
     */
    private static $instance;

    /**
     * Used for interacting with the users table.
     *
     * @var UserModel
     */
    private $userModel;

    /**
     * Initializes a new instance of the DataAccess class.
     *
     * @param UserModel $userModel The user model.
     */
    private function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Gets the User Model.
     *
     * @return UserModel
     */
    public function users()
    {
        return $this->userModel;
    }

    /**
     * Gets the singleton instance of DataAccess.
     *
     * @return DataAccess
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::setInstance();

        return self::$instance;
    }

    /**
     * Creates the new DataAccess singleton.
     *
     * @return void
     */
    private static function setInstance()
    {
        $userModel = new UserModel();
        self::$instance = new DataAccess($userModel);
    }
}