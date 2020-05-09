<?php

define('ROOT', dirname(__FILE__));
DEFINE('BASE', ROOT.'/mvc');
require ROOT.'/vendor/autoload.php';

use Mvc\Routes\Route;

$routes = new Route();
$routes->startRoute();
