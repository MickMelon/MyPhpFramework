<?php
require_once('vendor/autoload.php');

use Framework\Core\Startup;
use Framework\App\Config;

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$lengthWithoutRoot = strlen($path) - strlen(Config::SITE_ROOT);
$path = substr($path, -($lengthWithoutRoot));

$param = strpos($path, '?');
if ($param)
{
    $path = substr($path, 0, $param);
}

$startup = new Startup();
$startup->start($path, $method);