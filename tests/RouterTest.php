<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use Core\Router;
use Core\Request;

final class RouterTest extends TestCase
{
    public function testCanAddGetRoute()
    {
        // Arrange
        $router = new Router();
        $request = new Request('GET', '/about');

        // Act  
        $router->get('/about', 'Home@About');
        $handler = $router->match($request);

        // Assert
        $this->assertEquals('Home', $handler['Controller']);
        $this->assertEquals('About', $handler['Action']);
        $this->assertEquals(0, sizeof($handler['Options']));
    }

    public function testCanAddGetRouteWithRequireAuthOption()
    {
        // Arrange
        $router = new Router();
        $request = new Request('GET', '/about');

        // Act  
        $router->get('/about', 'Home@About', array('RequireAuth'));
        $handler = $router->match($request);

        // Assert
        $this->assertEquals('Home', $handler['Controller']);
        $this->assertEquals('About', $handler['Action']);
        $this->assertTrue(in_array('RequireAuth', $handler['Options']));
    }

    public function testCanAddPostRoute()
    {
        // Arrange
        $router = new Router();
        $request = new Request('POST', '/submit');

        // Act  
        $router->post('/submit', 'Login@Submit');
        $handler = $router->match($request);

        // Assert
        $this->assertEquals('Login', $handler['Controller']);
        $this->assertEquals('Submit', $handler['Action']);
    }

    public function testCanAddPostRouteWithRequireAuthOption()
    {
        // Arrange
        $router = new Router();
        $request = new Request('POST', '/submit');

        // Act  
        $router->post('/submit', 'Login@Submit', array('RequireAuth'));
        $handler = $router->match($request);

        // Assert
        $this->assertEquals('Login', $handler['Controller']);
        $this->assertEquals('Submit', $handler['Action']);
        $this->assertTrue(in_array('RequireAuth', $handler['Options']));
    }

    public function testMatchInvalidRequestMethodReturnsFalse()
    {
        // Arrange
        $router = new Router();
        $router->get('/home', 'Home@Home');
        $request = new Request('InvalidMethod', '/home');

        // Act
        $handler = $router->match($request);

        // Assert
        $this->assertFalse($handler);
    }

    public function testMatchInvalidRequestPathReturnsFalse()
    {
        // Arrange
        $router = new Router();
        $router->get('/home', 'Home@Home');
        $request = new Request('GET', '/invalidpath');

        // Act
        $handler = $router->match($request);

        // Assert
        $this->assertFalse($handler);
    }
}