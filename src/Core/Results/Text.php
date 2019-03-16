<?php
namespace Core\Results;

use Core\Results\IActionResult;

class Text implements IActionResult
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function execute()
    {
        echo "$this->text\n";
    }
}