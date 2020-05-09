<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Domain\Models\Debtor;
use Domain\UseCase\AddDebtor;
use Presentation\Errors\MissingParamError;
use Presentation\Errors\ServerError;
use Presentation\Helpers\HttpResponse;
use Presentation\Protocols\Controller;

class RegisterDebtor implements Controller{
  private $addDebtorIm;

  public function __construct(AddDebtor $addDebtor)
  {
    $this->addDebtorIm = $addDebtor;
  }

  public function handle($htppRequest): HttpResponse
  {
    try{
      $response = new HttpResponse();
      $requiredFields = ['name','cpfCnpj','birthdate', 'address'];

      foreach ($requiredFields as $field) {
        if(!isset($htppRequest['body'][$field])) {
          $response->withStatus(400);
          $response->withBody(new MissingParamError($field));
          return $response;
        }
      }

      $debtorFields = $htppRequest['body'];
      $register = $this->addDebtorIm->add(new Debtor($debtorFields['name'], $debtorFields['cpfCnpj'], $debtorFields['birthdate'], $debtorFields['address']));
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