<?php

use Domain\Models\Debt;
use Domain\Usecase\AddDebt;
use PHPUnit\Framework\TestCase;
use Presentation\Controllers\RegisterDebt;
use Presentation\Errors\MissingParamError;

class RegisterDebtStub implements AddDebt {
  public function add(Debt $dept) {
    $register = [
      'id' => 'valid_id',
      'debtorId' => 'valid_id',
      'debtTitle' => 'valid_title',
      'value' => 5,
      'endDate' => 'valid_date',
    ];
    return $register;
  }
}

class RegisterDebtTest extends TestCase{

  public function testReturnsErrorIfNoDebtTitleProvided()
  {
    $sut = new RegisterDebt(new RegisterDebtStub());
    $httpRequest = [
      'body' => [
        'debtorId' => 1,
        'value' => 'valid_value',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("debtTitle"));
  }

  public function testReturnsErrorIfNoValueProvided()
  {
    $sut = new RegisterDebt(new RegisterDebtStub());
    $httpRequest = [
      'body' => [
        'debtorId' => 1,
        'debtTitle' => 'valid_title',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("value"));
  }

  public function testReturnsErrorIfNoEndDateProvided()
  {
    $sut = new RegisterDebt(new RegisterDebtStub());
    $httpRequest = [
      'body' => [
        'debtorId' => 1,
        'value' => 'valid_value',
        'debtTitle' => 'valid_title',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("endDate"));
  }

  public function testReturnsErrorIfNoDebtorIdProvided()
  {
    $sut = new RegisterDebt(new RegisterDebtStub());
    $httpRequest = [
      'body' => [
        'value' => 'valid_value',
        'debtTitle' => 'valid_title',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("debtorId"));
  }

  public function testReturnsOkAndRegisterIfAllFieldsProvided()
  {
    $sut = new RegisterDebt(new RegisterDebtStub());
    $httpRequest = [
      'body' => [
        'debtorId' => 1,
        'debtTitle' => 'valid_title',
        'value' => 5.55,
        'endDate' => '10/10/2020',
      ]
    ];

    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), [
      'id' => 'valid_id',
      'debtorId' => 'valid_id',
      'debtTitle' => 'valid_title',
      'value' => 5,
      'endDate' => 'valid_date',
    ]);
  }
}