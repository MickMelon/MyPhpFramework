<?php
namespace Framework\Core;

use Framework\Core\Request;
use Framework\App\Config;
use Framework\App\Models\UserModel;
use Framework\App\Models\DataAccess;

class Router2
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($pattern, $actionPath)
    {
        $this->routes['GET'][$pattern] = $this->getHandler($actionPath);
        return $this;
    }

    public function post($pattern, callable $handler)
    {
        $this->routes['POST'][$pattern] = $handler;
        return $this;
    }

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