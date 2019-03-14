<?php
namespace Framework\Core;

use Framework\Core\Results\ViewResult;

class Dispatcher
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request)
    {
        $handler = $this->router->match($request);
        if (!$handler)
        {
            ViewResult::error('404 Page Not Found')->execute();
            return;
        }

        $controller = $handler->getController();
        $action = $handler->getAction();
        $params = $request->getParams();

        $controller->withParams($params);
        $result = $controller->{ $action }();
        $result->execute();
    }
}