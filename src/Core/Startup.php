<?php
namespace Framework\Core;

use Framework\App\Config;

class Startup
{
    public function start($path, $method)
    {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        session_start();
        
        $params = $this->getParams($method);
        $request = new Request($method, $path, $params);

        $router = $this->setupRouter();
        $dispatcher = new Dispatcher($router);   

        $dispatcher->handle($request);
    }

    private function getParams($method)
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

    private function setupRouter()
    {
        $router = new Router();
        $router
            ->get('/', 'Home@Home')
            ->get('/home', 'Home@Home')
            ->get('/test', 'Home@Test')
            ->get('/test/params', 'Home@ParamsTest');
        return $router;
    }
}
