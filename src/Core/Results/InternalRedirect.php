<?php
namespace Core\Results;

use Core\Results\IActionResult;
use App\Config;

class InternalRedirect implements IActionResult
{
    private $method;
    private $path;
    private $params;

    public function __construct(string $method, string $path, array $params = array())
    {
        $this->method = $method;
        $this->path = $path;
        $this->params = $params;
    }

    public function execute()
    {
        $url = Config::SITE_DOMAIN . Config::SITE_ROOT . $this->path;
        $options = array(
            'http' => array(
                'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
                'method' => $this->method,
                'content' => http_build_query($this->params)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE)
        {
            throw new Exception("InternalRedirectResult to $this->path via $this->method failed.");
        }

        print($result);    
    }
}