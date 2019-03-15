<?php
namespace Core;

use App\Models\DataAccess;

class ControllerFactory
{
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