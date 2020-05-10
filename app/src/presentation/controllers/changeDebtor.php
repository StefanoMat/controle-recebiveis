<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use DateTime;
use Domain\Models\Debtor;
use Domain\UseCase\UpdateDebtor;
use Presentation\Errors\ServerError;
use Presentation\Protocols\Controller;
use Presentation\Helpers\HttpResponse;
use Presentation\Errors\MissingParamError;
use Presentation\Helpers\Format;

class ChangeDebtor implements Controller{

  public function handle($httpRequest)
  {
    try{
      $response = new HttpResponse();
      $requiredFields = ['id', 'name', 'cpfCnpj', 'birthdate', 'address'];

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
      $response->withBody($e);
      return $response;
    }
  }

  private function __mapDebtor(array $debtorFields) : Debtor
  {
    $birthdateInDate = new DateTime($debtorFields['birthdate']);
    $debtor = new Debtor($debtorFields['name'], $debtorFields['cpfCnpj'], $birthdateInDate, $debtorFields['address']);
    $debtor->setId($debtorFields['id']);
    return $debtor;
  }
}