<?php
namespace Core;

/**
 * The DataAccess interface.
 */
interface IDataAccess
{
    /**
     * Gets the DataAccess instance.
     *
     * @return DataAccess
     */
    public static function getInstance();

    /**
     * Gets the users model.
     *
     * @return UserModel
     */
    public function users();
}