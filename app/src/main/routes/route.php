<?php
namespace Main\Routes;

use Main\Factory\Controllers\RegisterDebtorFactory;
use Main\Factory\Controllers\RegisterDebtFactory;
use Main\Factory\Controllers\LoadReceivablesFactory;
use Main\Factory\Controllers\ChangeDebtFactory;
use Main\Factory\Controllers\ChangeDebtorFactory;
use Main\Adapter\RouteAdapter;

class Route {

  private $dispatcher;

  public function __construct()
  {
    $this->dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
      $r->addRoute('POST', '/debtor', 'post_debtor');
      $r->addRoute('POST', '/debt', 'post_debt');
      $r->addRoute('GET', '/debt', 'get_debt');
      $r->addRoute('POST', '/put-debt', 'put_debt');
      $r->addRoute('POST', '/put-debtor', 'put_debtor');
    });
  }

  public function startRoute()
  {
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode(BASE, $uri, 2);
    $uri = $parts[1];
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
      case \FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
      case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
      case \FastRoute\Dispatcher::FOUND:
        if($routeInfo[1] == 'post_debtor') {
          $debtorController = new RegisterDebtorFactory();
          new RouteAdapter($debtorController->create(), $httpMethod);
        } else if ($routeInfo[1] == 'post_debt') {
          $debtController = new RegisterDebtFactory();
          new RouteAdapter($debtController->create(), $httpMethod);
        } else if ($routeInfo[1] == 'get_debt') {
          $loadReceivablesController = new LoadReceivablesFactory();
          new RouteAdapter($loadReceivablesController->create(), $httpMethod);
        } else if ($routeInfo[1] == 'put_debt') {
          $changeDebtController = new ChangeDebtFactory();
          new RouteAdapter($changeDebtController->create(), $httpMethod);
        } else if ($routeInfo[1] == 'put_debtor') {
          $changeDebtorController = new ChangeDebtorFactory();
          new RouteAdapter($changeDebtorController->create(), $httpMethod);
        }
        break;
    }
  }

}