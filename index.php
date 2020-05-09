<?php

require './vendor/autoload.php';
define('ROOT', dirname(__FILE__));

use Main\Routes\Route;
$routes = new Route();
$routes->startRoute();
