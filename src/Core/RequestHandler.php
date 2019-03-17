<?php
namespace Core;

use App\Models\DataAccess;

/**
 * The request handler.
 */
class RequestHandler
{
    /**
     * The instance of the controller that will handle the request.
     *
     * @var BaseController
     */
    private $controller;

    /**
     * The action to be invoked on the controller. (the method)
     *
     * @var string
     */
    private $action;

    /**
     * Initializes a new instance of the RequestHandler class.
     *
     * @param BaseController $controller The controller instance.
     * @param string $action The action to be invoked on the controller.
     */
    public function __construct(BaseController $controller, string $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        $controller = $this->controller;
        $action = $this->action;

        $result = $controller->{ $action }();
        $result->execute();
    }

    /**
     * Makes the RequestHandler for the given action path.
     *
     * @param string $actionPath The controller and action. 
     *               Ex: Home@About where Home is the controller name and About is
     *               the action name. {Controller}@{Action}
     * @return RequestHandler The RequestHandler or false if none found.
     */
    public static function make($actionPath): RequestHandler
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