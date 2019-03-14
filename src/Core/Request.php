<?php
namespace Framework\Core;

class Request
{
    private $method;
    private $path;
    private $params;

    public function __construct($method, $path, $params = array())
    {
        $this->method = $method;
        $this->path = $path;
        $this->params = $params;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getParams()
    {
        return $this->params;
    }
}