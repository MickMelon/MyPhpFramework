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

        echo $path;

        $router = new Router();
        $router
            ->get('/', 'Home@Home')
            ->get('/home', 'Home@Home')
            ->get('/test', 'Home@Test');

        $request = new Request($method, $path);
        
        $dispatcher = new Dispatcher($router);
        $dispatcher->handle($request);
    }
}
