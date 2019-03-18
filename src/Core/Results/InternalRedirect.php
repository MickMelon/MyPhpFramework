<?php
namespace Core\Results;

use Core\Results\IActionResult;
use App\Config;

/**
 * Used to redirect the user to somewhere that is internal to the application.
 */
class InternalRedirect implements IActionResult
{
    /**
     * The request method. 
     *
     * @var string
     */
    private $method;

    /**
     * The path in the URI. ie. /home
     *
     * @var string
     */
    private $path;

    /**
     * The parameters to be sent with the request.
     *
     * @var array
     */
    private $params;

    /**
     * Initializes a new instance of the InternalRedirect class.
     *
     * @param string $method The request method.
     * @param string $path The path in the URI.
     * @param array $params The parameters to be sent.
     */
    public function __construct(string $method, string $path, array $params = array())
    {
        $this->method = $method;
        $this->path = trim($path, '/');
        $this->params = $params;
    }

    /**
     * Executes the InternalRedirect.
     *
     * @return void
     */
    public function execute()
    {
        if ($this->method === 'GET')
        {
            $this->executeGet();
        }
        else if ($this->method === 'POST')
        {
            $this->executePost();
        }
    }

    /**
     * Executes an InternalRedirect with the GET method.
     *
     * @return void
     */
    private function executeGet()
    {
        $url = Config::SITE_DOMAIN . Config::SITE_ROOT . $this->path;

        if (sizeof($this->params) > 0)
        {
            $url .= '?' . http_build_query($this->params);
        }
        
        header('Location: ' . $url);
    }

    /**
     * Executes an InternalRedirect with the POST method.
     *
     * @return void
     */
    private function executePost()
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