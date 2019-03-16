<?php
namespace Core;

use App\Models\DataAccess;

/**
 * Used to create new controllers.
 */
class ControllerFactory
{
    /**
     * Makes a new controller if one exists for the given name.
     *
     * @param [type] $name The controller name. (do not include 'Controller' as part of the name)
     * @return BaseController The controller or false if none found.
     */
    public static function make($name)
    {
        $className = 'App\Controllers\\' . ucfirst($name) . 'Controller';
        if (class_exists($className, true))
        {
            $controller = new $className(DataAccess::getInstance());
            return $controller;
        }

        return false;
    }
}