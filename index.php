<?php
session_start();
require_once('vendor/autoload.php');

use Framework\Core\Router;

error_reporting(E_ALL);
ini_set("display_errors", 1);

$router = new Router();
$router->start();