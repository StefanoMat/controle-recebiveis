<?php

use Domain\Usecase\DeleteReceivables;
use Presentation\Errors\MissingParamError;
use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\RemoveReceivable;

class DeleteReceivableStub implements DeleteReceivables{
  public function delete($debtorId, $debtId)
  {
    $register = [
        'id' => 'valid_id',
        'name' => 'valid_name',
        'cpfCnpj' => 0,
        'birthdate' => 'valid_birthdate',
        'address' => 'valid_address',
        'value' => 'valid_value',
        'debtDescription' => 'valid_description',
        'endDate' => 'valid_date'
    ];
    return $register;
  }
}

class RemoveReceivableTest extends TestCase{

  public function testReturnsErrorIfNoDebtorIdProvided()
  {
    $sut = new RemoveReceivable(new DeleteReceivableStub());

    $httpRequest = [];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("debtorId"));
  }
}