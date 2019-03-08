<?php
require_once('vendor/autoload.php');

use Framework\Core\Startup;

echo $_SERVER['REQUEST_URI'];

$startup = new Startup();
$startup->start();
