<?php
declare(strict_types=1);

namespace Main\Adapter;

use Presentation\Protocols\Controller;
class RouteAdapter {
  

  public function __construct(Controller $controller)
  {
    $controller->handle($_POST);
  }

}