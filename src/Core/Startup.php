<?php
namespace Framework\Core;

use Framework\App\Config;

class Startup
{
    public function start()
    {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        session_start();

        $router = new Router2();
        $router
            ->get('/', 'Home@Home')
            ->get('/home', 'Home@Home')
            ->get('/test', 'Home@Test');

        $path = $_SERVER['REQUEST_URI'];
        $length = strlen($path) - strlen(Config::SITE_ROOT);
        $path = substr($path, -($length));

        $request = new Request('GET', $path);
        
        $dispatcher = new Dispatcher($router);
        $dispatcher->handle($request);
    }
}
