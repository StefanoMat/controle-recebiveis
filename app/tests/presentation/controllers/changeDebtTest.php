<?php

use Domain\Models\Debt;
use Domain\Usecase\UpdateDebt;
use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\ChangeDebt;
use Presentation\Errors\MissingParamError;

class ChangeDebtStub implements UpdateDebt{
  public function update(Debt $debt)
  {
    $registers = [
      'id' => 'valid_id',
      'debtorId' => 'valid_id',
      'debtDescription' => 'valid_description',
      'value' => 5,
      'endDate' => 'valid_date',
    ];
    return $registers;
  }
}
class ChangeDebtTest extends TestCase {

  public function testReturnsErrorIfNoIdProvided()
  {
    $sut = new ChangeDebt(new ChangeDebtStub());
    $httpRequest = [
      'body' => [
        'debtorId' => 1,
        'debtDescription' => 'valid_description',
        'value' => 'valid_value',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("id"));
  }

  public function testReturnsErrorIfNodebtDescriptionProvided()
  {
    $sut = new ChangeDebt(new ChangeDebtStub());
    $httpRequest = [
      'body' => [
        'id' => '1',
        'debtorId' => 1,
        'value' => 'valid_value',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("debtDescription"));
  }

  public function testReturnsErrorIfNoValueProvided()
  {
    $sut = new ChangeDebt(new ChangeDebtStub());
    $httpRequest = [
      'body' => [
        'id' => '1',
        'debtorId' => 1,
        'debtDescription' => 'valid_description',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("value"));
  }

  public function testReturnsErrorIfNoEndDateProvided()
  {
    $sut = new ChangeDebt(new ChangeDebtStub());
    $httpRequest = [
      'body' => [
        'id' => '1',
        'debtorId' => 1,
        'value' => 'valid_value',
        'debtDescription' => 'valid_description',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("endDate"));
  }

  public function testReturnsErrorIfNoDebtorIdProvided()
  {
    $sut = new ChangeDebt(new ChangeDebtStub());
    $httpRequest = [
      'body' => [
        'id' => 1,
        'value' => 'valid_value',
        'debtDescription' => 'valid_description',
        'endDate' => 'valid_date',
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("debtorId"));
  }
  public function testReturnsOkAndRegistersOfRequest()
  {
    $sut = new ChangeDebt(new ChangeDebtStub());

    $httpRequest = [
      'body' => [
        'id' => 2,
        'debtorId' => 1,
        'debtDescription' => 'valid_description',
        'value' => 5.55,
        'endDate' => '10/10/2020',
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getStatusCode(), 200);
    $this->assertEquals($response->getBody(), [
      'id' => 'valid_id',
      'debtorId' => 'valid_id',
      'debtDescription' => 'valid_description',
      'value' => 5,
      'endDate' => 'valid_date',
    ]);
  }
}