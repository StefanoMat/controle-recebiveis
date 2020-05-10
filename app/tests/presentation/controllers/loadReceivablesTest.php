<?php

use Domain\Usecase\GetReceivables;
use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\LoadReceivables;

class GetReceivablesStub implements GetReceivables{
  public function get()
  {
    $registers = [
      0 => [
        'id' => 'valid_id',
        'name' => 'valid_name',
        'cpfCnpj' => 0,
        'birthdate' => 'valid_birthdate',
        'address' => 'valid_address',
        'value' => 'valid_value',
        'debtDescription' => 'valid_description',
        'endDate' => 'valid_date'
      ]
    ];
    return $registers;
  }
}
class LoadReceivablesTest extends TestCase {

  public function testReturnsOkAndRegistersOfRequest()
  {
    $sut = new LoadReceivables(new GetReceivablesStub());

    $httpRequest = [];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getStatusCode(), 200);
    $this->assertEquals($response->getBody(), [
      0 => [
        'id' => 'valid_id',
        'name' => 'valid_name',
        'cpfCnpj' => 0,
        'birthdate' => 'valid_birthdate',
        'address' => 'valid_address',
        'value' => 'valid_value',
        'debtDescription' => 'valid_description',
        'endDate' => 'valid_date'
      ]
    ]);
  }
}