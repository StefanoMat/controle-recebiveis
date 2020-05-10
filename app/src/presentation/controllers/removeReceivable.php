<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Domain\Usecase\DeleteReceivables;
use Presentation\Protocols\Controller;
use Presentation\Helpers\HttpResponse;
use Presentation\Errors\ServerError;
use Presentation\Errors\MissingParamError;

class RemoveReceivable implements Controller{

  private $deleteReceivables;

  public function __construct(DeleteReceivables $deleteReceivables)
  {
    $this->deleteReceivables = $deleteReceivables;
  }

  public function handle($httpRequest) : HttpResponse
  {
    try{
      $response = new HttpResponse();
      $requiredFields = ['debtorId', 'debtId'];

      foreach ($requiredFields as $field) {
        if(!isset($httpRequest['body'][$field])) {
          $response->withStatus(400);
          $response->withBody(new MissingParamError($field));
          return $response;
        }
      }
      $fields = $httpRequest['body'];
      $register = $this->deleteReceivables->delete((int) $fields['debtorId'],(int) $fields['debtId']);
      $response->withStatus(200);
      $response->withBody($register);
      return $response;
    } catch(\Exception $e) {
      $response->withStatus(500);
      $response->withBody($e);
      return $response;
    }
  }

}