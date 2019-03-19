<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use Core\Router;
use Core\Request;

final class RequestTest extends TestCase
{
    public function testCanCreateRequestWithoutParams()
    {
        // Arrange & Act
        $request = new Request('GET', '/home');

        // Assert
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/home', $request->getPath());
        $this->assertEquals(0, sizeof($request->getParams()));
    }

    public function testCanCreateRequestWithParams()
    {
        // Arrange & Act
        $request = new Request('POST', '/about', array(
            'Param1' => 'Value1',
            'Param2' => 'Value2'
        ));

        // Assert
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/about', $request->getPath());
        $this->assertEquals('Value1', $request->getParams()['Param1']);
        $this->assertEquals('Value2', $request->getParams()['Param2']);
    }
}
