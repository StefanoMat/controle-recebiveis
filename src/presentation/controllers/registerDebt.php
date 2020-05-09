<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Presentation\Protocols\Controller;
use Presentation\Helpers\HttpResponse;
use Presentation\Errors\MissingParamError;

class RegisterDebt implements Controller {
  public function handle($httpRequest) {
    try{
      $response = new HttpResponse();
      $requiredFields = ['debtTitle','value','endDate'];

      foreach ($requiredFields as $field) {
        if(!isset($httpRequest['body'][$field])) {
          $response->withStatus(400);
          $response->withBody(new MissingParamError($field));
          return $response;
        }
      }
      return $response;
    } catch(\Exception $e) {
      
    }
  }

}