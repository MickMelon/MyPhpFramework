<?php
namespace Core;

use Core\Results;
use Core\Util\Session;
use Core\Factories\ControllerFactory;
use Core\Factories\RepositoryFactory;
use Core\Factories\ServiceFactory;

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

    private $controllerFactory;
    private $repositoryFactory;
    private $serviceFactory;

    /**
     * Initializes a new instance of the Dispatcher class.
     *
     * @param Router $router The router.
     */
    public function __construct(Router $router,
        ControllerFactory $controllerFactory,
        RepositoryFactory $repositoryFactory,
        ServiceFactory $serviceFactory)
    {
        $this->router = $router;
        $this->controllerFactory = $controllerFactory;
        $this->repositoryFactory = $repositoryFactory;
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * Handles the given request.
     *
     * @param Request $request The request.
     * @return void
     */
    public function dispatch(Request $request)
    {
        $handler = $this->router->match($request);

        if ($handler && isset($handler['Controller']) && isset($handler['Action']))
        {            
            $controllerName = $handler['Controller'];
            $actionName = $handler['Action'];
            $options = $handler['Options'];

            if (in_array('RequireAuth', $options))
            {
                if (!Session::isLoggedIn())
                {
                    $result = new Results\InternalRedirect('GET', '/login', array(
                        'test' => 'lol',
                        'etstse' => '123'
                    ));
                    $result->execute();
                    return;
                }
            }

            $controller = $this->controllerFactory->make($controllerName);

            if (method_exists($controller, $actionName))
            {
                $result = $controller->{ $actionName }($request);
                $result->execute();
                return;
            }
        }

        Results\View::error('404 Page Not Found')->execute();
    }
}