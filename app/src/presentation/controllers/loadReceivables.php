<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Presentation\Protocols\Controller;
use Presentation\Helpers\HttpResponse;
use Domain\Usecase\GetReceivables;
use Presentation\Errors\ServerError;

class LoadReceivables implements Controller{

  private $getReceivablesIm;

  public function __construct(GetReceivables $getReceivables)
  {
    $this->getReceivablesIm = $getReceivables;
  }
  public function handle($httpRequest) : HttpResponse
  {
    try{
      $response = new HttpResponse();

      $register = $this->getReceivablesIm->get();
      $response->withStatus(200);
      $response->withBody($register);
      return $response;
    } catch(\Exception $e) {
      $response->withStatus(500);
      $response->withBody(new ServerError);
      return $response;
    }
  }

}