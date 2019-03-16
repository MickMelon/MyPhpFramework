<?php
namespace Core;

/**
 * The request.
 */
class Request
{
    /**
     * The request method. i.e. POST or GET.
     *
     * @var string
     */
    private $method;

    /**
     * The path in the URI. Ex: /home or /user/2/profile
     *
     * @var string
     */
    private $path;

    /**
     * The parameters associated with the request. (taken from POST and GET)
     *
     * @var array
     */
    private $params;

    /**
     * Initializes a new instance of the Request class.
     *
     * @param string $method The request method. i.e. POST or GET.
     * @param string $path The path in the URI.
     * @param array $params The parameters associated with the request.
     */
    public function __construct($method, $path, $params = array())
    {
        $this->method = $method;
        $this->path = $path;
        $this->params = $params;
    }

    /**
     * Gets the request method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Gets the request path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Gets the request parameters.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}