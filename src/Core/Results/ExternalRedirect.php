<?php
namespace Core\Results;

use Core\Results\IActionResult;

/**
 * Used to redirect the user to a location that is not within the application.
 */
class ExternalRedirect implements IActionResult
{
    /**
     * The URL to take the user to.
     *
     * @var string
     */
    private $url;

    /**
     * The delay in seconds before the redirect takes place.
     *
     * @var int
     */
    private $delaySeconds;

    /**
     * Initializes a new instance of the ExternalRedirect class.
     *
     * @param string $url The URL to take the user to.
     * @param integer $delaySeconds The delay in seconds before the redirect takes place.
     */
    public function __construct(string $url, int $delaySeconds = 0)
    {
        $this->url = $url;
        $this->delaySeconds = $delaySeconds;
    }

    /**
     * Executes the ExternalRedirect.
     *
     * @return void
     */
    public function execute()
    {
        if ($this->delaySeconds > 0)
            sleep($this->delaySeconds);

        header('Location: ' . $this->url);
    }
}