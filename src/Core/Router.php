<?php
namespace Framework\Core;

use Framework\Core\Request;
use Framework\App\Config;
use Framework\App\Models\UserModel;
use Framework\App\Models\DataAccess;

/**
 * Undocumented class
 */
class Router
{
    /**
     * The array of routes that stores all the action handlers for each
     * request method.
     */
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Adds a GET route.
     *
     * @param string $pattern The pattern in the URL for this route. Ex: '/home'
     * @param string $actionPath The controller and action. 
     *               Ex: Home@About where Home is the controller name and About is
     *               the action name. {Controller}@{Action}
     * @return Router This router.
     */
    public function get($pattern, $actionPath)
    {
        return $this->addRoute('GET', $pattern, $actionPath);
    }

    /**
     * Adds a POST route.
     *
     * @param string $pattern The pattern in the URL for this route. Ex: '/home'
     * @param string $actionPath The controller and action. 
     *               Ex: Home@About where Home is the controller name and About is
     *               the action name. {Controller}@{Action}
     * @return Router This router.
     */
    public function post($pattern, $actionPath)
    {
        return $this->addRoute('POST', $pattern, $actionPath);
    }

    /**
     * Adds a route.
     *
     * @param string $method The HTTP request method type. Ex: 'GET' or 'POST'
     * @param string $pattern The pattern in the URL for this route. Ex: '/home'
     * @param string $actionPath The controller and action. 
     *               Ex: Home@About where Home is the controller name and About is
     *               the action name. {Controller}@{Action}
     * @return Router This router.
     */
    public function addRoute($method, $pattern, $actionPath)
    {
        $this->routes[$method][$pattern] = $this->getHandler($actionPath);
        return $this;
    }

    /**
     * Gets the RequestHandler for the given action path.
     *
     * @param string $actionPath The controller and action. 
     *               Ex: Home@About where Home is the controller name and About is
     *               the action name. {Controller}@{Action}
     * @return RequestHandler The RequestHandler or false if none found.
     */
    private function getHandler($actionPath)
    {
        $explode = explode('@', $actionPath);

        $controller = $explode[0];
        $action = $explode[1];

        $className = 'Framework\App\Controllers\\' . ucfirst($controller) . 'Controller';
        if (class_exists($className, true))
        {
            $controllerInstance = new $className(new DataAccess(new UserModel()));
            if (method_exists($controllerInstance, $action))
            {
                $handler = new RequestHandler($controllerInstance, $action);
                return $handler;
            }
        }

        return false;
    }

    /**
     * Gets the RequestHandler from the routes array if there
     * is one that matches the Request.
     *
     * @param Request $request The HTTP request to check to see if there is a match for.
     * @return RequestHandler The RequestHandler or false if none found.
     */
    public function match(Request $request)
    {
        $method = strtoupper($request->getMethod());

        if (!isset($this->routes[$method]))
            return false;

        $path = $request->getPath();
        foreach ($this->routes[$method] as $pattern => $handler)
            if (strtolower($pattern) === $path)
                return $handler;

        return false;
    }
}