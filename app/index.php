<?php

define('ROOT', dirname(__FILE__));
define('BASE', '/app');

require ROOT.'/vendor/autoload.php';

use Main\Routes\Route;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$routes = new Route();
$routes->startRoute();
