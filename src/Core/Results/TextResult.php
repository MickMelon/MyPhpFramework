<?php
namespace Core\Results;

use Core\Results\IActionResult;

class TextResult implements IActionResult
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function execute()
    {
        echo "$this->text\n";
    }
}