<?php
namespace Core\Results;

use Core\Results\IActionResult;

/**
 * The Json ActionResult used to display Json data.
 */
class Json implements IActionResult
{
    /**
     * The Json data.
     *
     * @var json
     */
    private $data;

    /**
     * Initializes a new instance of the Json class.
     *
     * @param json $data the Json data.
     */
    public function __construct($data) 
    {
        $this->data = json_encode($data);
    }

    /**
     * Prints the Json data.
     *
     * @return void
     */
    public function execute()
    {
        header('Content-Type: application/json');
        echo $this->data;
    }
}