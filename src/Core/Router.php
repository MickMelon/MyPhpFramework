<?php
namespace Core;

use App\Config;
use Exception;

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
    public function get(string $pattern, string $actionPath)
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
    public function post(string $pattern, string $actionPath)
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
    public function addRoute(string $method, string $pattern, string $actionPath)
    {
        $handler = RequestHandler::make($actionPath);
        if (!$handler)
            throw new Exception('Could not find valid route for action path: ' . $actionPath);

        $pattern = trim($pattern, '/');

        $this->routes[$method][$pattern] = $handler;
        return $this;
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

        $path = trim($request->getPath(), '/');

        foreach ($this->routes[$method] as $pattern => $handler)
            if (strtolower($pattern) === $path)
                return $handler;

        return false;
    }
}