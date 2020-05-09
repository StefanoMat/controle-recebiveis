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
    if ($response->getStatusCode() >= 200 && $response->getStatusCode() <=299) {
      http_response_code($response->getStatusCode());
      print json_encode($response->getBody());
    } else {
      http_response_code($response->getStatusCode());
      print json_encode($response->getBody()->getMessage());
    }
  }

}