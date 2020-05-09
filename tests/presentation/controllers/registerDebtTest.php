<?php

use PHPUnit\Framework\TestCase;
use Presentation\Errors\MissingParamError;

class RegisterDebtTest extends TestCase{

  public function testReturnsErrorIfNoDebtTitleProvided()
  {
    $sut = new RegisterDebt();
    $httpRequest = [
      'body' => [
        'value' => 'valid_cnpj',
        'endDate' => 'valid_date',
        'address' => 'valid_address'
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("debtTitle"));
  }
}