<?php

define('ROOT', dirname(__FILE__));
DEFINE('BASE', ROOT.'/mvc');
require ROOT.'/vendor/autoload.php';

use Mvc\Routes\Route;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$routes = new Route();
$routes->startRoute();
