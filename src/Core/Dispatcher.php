<?php
namespace Framework\Core;

class Dispatcher
{
    private $router;

    public function __construct(Router2 $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request)
    {
        $handler = $this->router->match($request);

        if (!$handler)
        {
            echo "Error";
            return;
        }

        $controller = $handler->getController();
        $action = $handler->getAction();
        $result = $controller->{ $action }();
        $result->execute();
    }
}