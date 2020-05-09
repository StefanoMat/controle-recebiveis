<?php

use PHPUnit\Framework\TestCase;
use Presentation\Errors\MissingParamError;
use Presentation\Controllers\RegisterDebt;

class RegisterDebtTest extends TestCase{

  public function testReturnsErrorIfNoDebtTitleProvided()
  {
    $sut = new RegisterDebt();
    $httpRequest = [
      'body' => [
        'value' => 'valid_value',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("debtTitle"));
  }
}