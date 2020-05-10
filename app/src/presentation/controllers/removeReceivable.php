<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Presentation\Protocols\Controller;
use Presentation\Helpers\HttpResponse;
use Presentation\Errors\ServerError;
use Presentation\Errors\MissingParamError;

class RemoveReceivable implements Controller{

  public function handle($httpRequest) : HttpResponse
  {
    try{
      $response = new HttpResponse();
      $requiredFields = ['id'];

      foreach ($requiredFields as $field) {
        if(!isset($httpRequest['body'][$field])) {
          $response->withStatus(400);
          $response->withBody(new MissingParamError($field));
          return $response;
        }
      }

      return $response;
    } catch(\Exception $e) {
      $response->withStatus(500);
      $response->withBody(new ServerError);
      return $response;
    }
  }

}