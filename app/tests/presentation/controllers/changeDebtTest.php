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

}