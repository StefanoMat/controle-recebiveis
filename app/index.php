<?php

define('ROOT', dirname(__FILE__));
define('BASE', '/app');

require ROOT.'/vendor/autoload.php';

use Main\Routes\Route;
$routes = new Route();
$routes->startRoute();
