<?php
namespace Mvc\Routes;

use Mvc\Controllers\DashboardController;

class Route {

  private $dispatcher;

  public function __construct()
  {
    $this->dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
      $r->addRoute('GET', '/', 'index');
    });
  }

  public function startRoute()
  {
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
   
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
        $controller = new DashboardController();
        if($routeInfo[1] == 'index') {
          $controller->index();
        }      
        break;
    }
  }

}