<?php

use Domain\Models\Debtor;
use Domain\Usecase\UpdateDebtor;
use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\ChangeDebtor;
use Presentation\Errors\MissingParamError;

class ChangeDebtorStub implements UpdateDebtor{
  public function update(Debtor $debtor)
  {
    $registers = [
      'id' => 'valid_id',
      'name' => 'valid_name',
      'cpfCnpj' => 0,
      'birthdate' => 'valid_birthdate',
      'address' => 'valid_address'
    ];
    return $registers;
  }
}

class ChangeDebtorTest extends TestCase {

  public function testReturnsErrorIfNoIdProvided()
  {
    $sut = new ChangeDebtor(new ChangeDebtorStub());
    $httpRequest = [
      'body' => [
        'name' => 'valid_name',
        'cpfCnpj' => 0,
        'birthdate' => 'valid_birthdate',
        'address' => 'valid_address'
        ] 
      ];

      $response = $sut->handle($httpRequest);
      $this->assertEquals($response->getBody(), new MissingParamError("id"));
  }

  public function testReturnsErrorIfNoNameProvided()
  {
    $sut = new ChangeDebtor(new ChangeDebtorStub());
    $httpRequest = [
      'body' => [
        'id' => 'valid_id',
        'cpfCnpj' => 'valid_cnpj',
        'birthdate' => 'valid_date',
        'address' => 'valid_address'
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("name"));
  }

  public function testReturnsErrorIfNoCpfCnpjProvided()
  {
    $sut = new ChangeDebtor(new ChangeDebtorStub());
    $httpRequest = [
      'body' => [
        'id' => 'valid_id',
        'name' => 'valid_name',
        'birthdate' => 'valid_date',
        'address' => 'valid_address'
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("cpfCnpj"));
  }

  public function testReturnsErrorIfNoBirthdateProvided()
  {
    $sut = new ChangeDebtor(new ChangeDebtorStub());
    $httpRequest = [
      'body' => [
        'id' => 'valid_id',
        'cpfCnpj' => 'valid_cnpj',
        'name' => 'valid_name',
        'address' => 'valid_address'
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("birthdate"));
  }

  public function testReturnsErrorIfNoAddressProvided()
  {
    $sut = new ChangeDebtor(new ChangeDebtorStub());
    $httpRequest = [
      'body' => [
        'id' => 'valid_id',
        'name' => 'valid_name',
        'cpfCnpj' => 'valid_cnpj',
        'birthdate' => 'valid_date',
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("address"));
  }

  public function testReturnsOkAndRegistersOfRequest()
  {
    $sut = new ChangeDebtor(new ChangeDebtorStub());

    $httpRequest = [
      'body' => [
        'id' => 1,
        'name' => 'valid_name',
        'cpfCnpj' => 'valid_cpf',
        'birthdate' => '10/10/2010',
        'address' => 'valid_address'
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getStatusCode(), 200);
    $this->assertEquals($response->getBody(), [
      'id' => 'valid_id',
      'name' => 'valid_name',
      'cpfCnpj' => 0,
      'birthdate' => 'valid_birthdate',
      'address' => 'valid_address'
    ]);
  }

}