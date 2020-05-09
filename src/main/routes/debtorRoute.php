<?php
namespace Main\Routes;

use Main\Factory\Controllers\RegisterDebtorFactory;
use Main\Adapter\RouteAdapter;

$dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
  $r->addRoute('POST', '/debtor', 'handler');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case \FastRoute\Dispatcher::FOUND:
        $debtorController = new RegisterDebtorFactory();
        new RouteAdapter($debtorController->create());
        break;
}