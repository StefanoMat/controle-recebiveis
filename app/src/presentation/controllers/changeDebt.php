<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use DateTime;
use Domain\Models\Debt;
use Domain\UseCase\UpdateDebt;
use Presentation\Errors\ServerError;
use Presentation\Protocols\Controller;
use Presentation\Helpers\HttpResponse;
use Presentation\Errors\MissingParamError;
use Presentation\Helpers\Format;

class ChangeDebt implements Controller{
  private $updateDebtIm;

  public function __construct(UpdateDebt $updateDebt)
  {
    $this->updateDebtIm = $updateDebt;
  }

  public function handle($httpRequest)
  {
    try{
      $response = new HttpResponse();
      $requiredFields = ['id', 'debtorId', 'debtDescription', 'value', 'endDate'];

      foreach ($requiredFields as $field) {
        if(!isset($httpRequest['body'][$field])) {
          $response->withStatus(400);
          $response->withBody(new MissingParamError($field));
          return $response;
        }
      }

      $debtFields = $httpRequest['body'];
      $debt = $this->__mapDebt($debtFields);
      $register = $this->updateDebtIm->update($debt);
      $response->withStatus(200);
      $response->withBody($register);
      return $response;
    } catch(\Exception $e) {
      $response->withStatus(500);
      $response->withBody($e);
      return $response;
    }
  }

  private function __mapDebt(array $debtFields) : Debt
  {
    $endDateInDate = new DateTime($debtFields['endDate']);
    $format = new Format();
    $valueInMoney = $format->decimal($debtFields['value']);
    $debt = new Debt((int) $debtFields['debtorId'],$debtFields['debtDescription'], (float) $valueInMoney, $endDateInDate);
    $debt->setId((int) $debtFields['id']);
    return $debt;
  }
}
