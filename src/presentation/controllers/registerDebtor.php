<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Domain\Models\Debtor;
use Domain\UseCase\AddDebtor;
use Presentation\Errors\MissingParamError;
use Presentation\Protocols\Controller;

class RegisterDebtor implements Controller{
  private $addDebtorIm;

  public function __construct(AddDebtor $addDebtor)
  {
    $this->addDebtorIm = $addDebtor;
  }

  public function handle($htppRequest)
  {
    try{
    $requiredFields = ['name','cpfCnpj','birthdate', 'address'];
    foreach ($requiredFields as $field) {
      if(!isset($htppRequest['body'][$field])) {
        return new MissingParamError("Missing ".$field);
      }
    }
    $debtorFields = $htppRequest['body'];
    $register = $this->addDebtorIm->add(new Debtor($debtorFields['name'], $debtorFields['cpfCnpj'], $debtorFields['birthdate'], $debtorFields['address']));
    print_r($register);
    return [
      'statusCode' => 200,
      'body' => $register
    ];

    } catch(\Error $e) {

    }
  }
  

}