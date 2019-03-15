<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

require_once('vendor/autoload.php');

use Core\Startup;
use App\Config;

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