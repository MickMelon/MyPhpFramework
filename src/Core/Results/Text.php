<?php
namespace Core\Results;

use Core\Results\IActionResult;

/**
 * ActionResult for showing plain-text. Created for CLI purposes.
 */
class Text implements IActionResult
{
    /**
     * The text to be printed.
     *
     * @var string
     */
    private $text;

    /**
     * Initializes a new instance of the Text class.
     *
     * @param string $text The text to be printed.
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * Prints the text.
     *
     * @return void
     */
    public function execute()
    {
        echo "$this->text\n";
    }
}