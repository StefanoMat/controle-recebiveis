<?php

use Domain\Models\Debtor;
use Domain\UseCase\AddDebtor;
use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\RegisterDebtor;
use Presentation\Errors\MissingParamError;

class RegisterDebtorStub implements AddDebtor {
  public function add(Debtor $deptor) {
    $account = [
      'id' => 'valid_id',
      'name' => 'valid_name',
      'cpfCnpj' => 0,
      'birthdate' => 'valid_birthdate',
      'address' => 'valid_address'
    ];
    return $account;
  }
}

class registerDebtorTest extends TestCase{
  public function testReturnsErrorIfNoNameProvided()
  {
    $sut = new RegisterDebtor(new RegisterDebtorStub());
    $httpRequest = [
      'body' => [
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
    $sut = new RegisterDebtor(new RegisterDebtorStub());
    $httpRequest = [
      'body' => [
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
    $sut = new RegisterDebtor(new RegisterDebtorStub());
    $httpRequest = [
      'body' => [
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
    $sut = new RegisterDebtor(new RegisterDebtorStub());
    $httpRequest = [
      'body' => [
        'name' => 'valid_name',
        'cpfCnpj' => 'valid_cnpj',
        'birthdate' => 'valid_date',
      ]
    ];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("address"));
  }

  public function testReturnsOkAndRegisterIfAllFieldsProvided()
  {
    $sut = new RegisterDebtor(new RegisterDebtorStub());
    $httpRequest = [
      'body' => [
        'name' => 'valid_name',
        'cpfCnpj' => 0,
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