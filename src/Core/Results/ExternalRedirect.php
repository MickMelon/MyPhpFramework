<?php
namespace Core\Results;

use Core\Results\IActionResult;

class ExternalRedirect implements IActionResult
{
    private $url;
    private $delaySeconds;

    public function __construct($url, $delaySeconds = 0)
    {
        $this->url = $url;
        $this->delaySeconds = $delaySeconds;
    }

    public function execute()
    {
        if ($this->delaySeconds > 0)
            sleep($this->delaySeconds);

        header('Location: ' . $this->url);
    }
}