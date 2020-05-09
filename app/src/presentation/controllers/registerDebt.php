<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use DateTime;
use Domain\Models\Debt;
use Domain\Usecase\AddDebt;
use Presentation\Helpers\HttpResponse;
use Presentation\Protocols\Controller;
use Presentation\Errors\MissingParamError;
use Presentation\Errors\ServerError;

class RegisterDebt implements Controller {
  private $addDebtIm;

  public function __construct(AddDebt $addDebt)
  {
    $this->addDebtIm = $addDebt;
  }

  public function handle($httpRequest) : HttpResponse
  {
    try{
      $response = new HttpResponse();
      $requiredFields = ['debtorId','debtDescription','value','endDate'];

      foreach ($requiredFields as $field) {
        if(!isset($httpRequest['body'][$field])) {
          $response->withStatus(400);
          $response->withBody(new MissingParamError($field));
          return $response;
        }
      }

      $debtFields = $httpRequest['body'];
      $debt = $this->__mapDebt($debtFields);
      $register = $this->addDebtIm->add($debt);
      $response->withStatus(200);
      $response->withBody($register);
      return $response;
    } catch(\Exception $e) {
      $response->withStatus(500);
      $response->withBody(new ServerError);
      return $response;
    }
  }

  private function __mapDebt(array $debtFields) : Debt
  {
    $endDateInDate = new DateTime($debtFields['endDate']);
    $debt = new Debt((int) $debtFields['debtorId'],$debtFields['debtDescription'], (float) $debtFields['value'], $endDateInDate);
    return $debt;
  }

}