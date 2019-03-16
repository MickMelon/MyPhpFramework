<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('vendor/autoload.php');

use Core\Startup;
use App\Config;

if (PHP_SAPI === 'cli') 
{
    if ($_SERVER["argc"] == 3)
    {
        $method = $_SERVER["argv"][1];
        $path = $_SERVER["argv"][2];
    }
    else
    {
        echo "USAGE: php index.php [method] [path]\n";
        return;
    }
}
else
{
    $path = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $lengthWithoutRoot = strlen($path) - strlen(Config::SITE_ROOT);
    $path = substr($path, -($lengthWithoutRoot));
}


$param = strpos($path, '?');
if ($param)
{
    $path = substr($path, 0, $param);
}

$startup = new Startup();
$startup->start($path, $method);