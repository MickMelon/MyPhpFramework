<?php
namespace Core;

use App\Models\DataAccess;

class RequestHandler
{
    private $controller;
    private $action;

    public function __construct($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    /**
     * Makes the RequestHandler for the given action path.
     *
     * @param string $actionPath The controller and action. 
     *               Ex: Home@About where Home is the controller name and About is
     *               the action name. {Controller}@{Action}
     * @return RequestHandler The RequestHandler or false if none found.
     */
    public static function make($actionPath)
    {
        $explode = explode('@', $actionPath);

        $controller = $explode[0];
        $action = $explode[1];

        $controllerInstance = ControllerFactory::make($controller);
        if ($controllerInstance !== FALSE && method_exists($controllerInstance, $action))
        {
            $handler = new RequestHandler($controllerInstance, $action);
            return $handler;
        }        

        return false;
    }
}