<?php
namespace Framework\App\Controllers;

use Framework\App\Models\DataAccess;

class ControllerFactory
{
    public static function make($name)
    {
        $className = 'Framework\App\Controllers\\' . ucfirst($name) . 'Controller';
        if (class_exists($className, true))
        {
            $controller = new $className(DataAccess::make());
            return $controller;
        }

        return false;
    }
}