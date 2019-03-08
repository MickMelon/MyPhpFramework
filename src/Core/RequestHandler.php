<?php
namespace Framework\Core;

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
}