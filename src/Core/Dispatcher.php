<?php
namespace Core;

use Core\Results\ViewResult;

/**
 * Undocumented class
 */
class Dispatcher
{
    /**
     * The router.
     *
     * @var Router
     */
    private $router;

    /**
     * Initializes a new instance of the Dispatcher class.
     *
     * @param Router $router The router.
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Handles the given request.
     *
     * @param Request $request The request.
     * @return void
     */
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