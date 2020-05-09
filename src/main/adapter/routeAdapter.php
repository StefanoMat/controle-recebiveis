<?php
declare(strict_types=1);

namespace Main\Adapter;

use Presentation\Protocols\Controller;
class RouteAdapter {
  

  public function __construct(Controller $controller)
  {
    $httpRequest = [
      'body' => $_POST
    ];
    $response = $controller->handle($httpRequest);
    print_r($response->getStatusCode(). '<br>');
    print_r($response->getBody()->getMessage());
  }

}