<?php
namespace Core;

use App\Config;

use Core\Util\Session;

use DI;

use Factories;

use Exception;

/**
 * Starts up the application.
 */
class Startup
{
    /**
     * Starts the application.
     *
     * @param string $path The URI.
     * @param string $method The request method. i.e. POST or GET
     * @return void
     */
    public function start(string $path, string $method)
    {
        $this->verifyApp();

        $params = $this->getParams($method);
        $request = new Request($method, $path, $params);

        Session::init();

        $router = $this->setupRouter();
        $container = $this->setupDiContainer();

        $dispatcher = new Dispatcher(
            $router,                        
            $container->get('Core\Factories\ControllerFactory'),
            $container->get('Core\Factories\RepositoryFactory'),
            $container->get('Core\Factories\ServiceFactory'));   
        $dispatcher->dispatch($request);
    }

    private function setupDiContainer()
    {
        $container = new DI\Container();

        return $container;
    }

    /**
     * Gets the POST or GET parameters if any.
     *
     * @param string $method The request method.
     * @return array
     */
    private function getParams(string $method): array
    {
        $params = array();

        if ($method == 'POST')
        {
            foreach ($_POST as $key => $val)
            {
                $params[$key] = filter_input(INPUT_POST, $key);
            }
        }
        else if ($method == 'GET')
        {
            foreach ($_GET as $key => $val)
            {
                $params[$key] = filter_input(INPUT_GET, $key);
            }
        }

        return $params;
    }

    /**
     * Adds all the routes to the router.
     *
     * @return Router
     */
    private function setupRouter()
    {
        $router = new Router();
        $router
            ->get('/', 'Home@Home')
            ->get('/home', 'Home@Home')
            ->get('/test', 'Home@Test')
            ->get('/test/params', 'Home@ParamsTest')
            ->get('/lol', 'Home@Lol')
            ->get('/login', 'Login@Index')
            ->post('/login/submit', 'Login@Submit');
        return $router;
    }

    /**
     * Check to make sure the required files exist in the App folder.
     * It will throw an exception if not.
     *
     * @return void
     */
    private function verifyApp()
    {
        if (!class_exists('App\Config'))
            throw new Exception('App\Config class not found.');
    }
}
