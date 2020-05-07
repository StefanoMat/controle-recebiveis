<?php

use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\RegisterDebtor;
use Presentation\Errors\MissingParamError;

class registerDebtorTest extends TestCase{
  public function testReturnsErrorIfNoNameProvided()
  {

    $sut = new RegisterDebtor();

    $httpRequest = [
      'body' => [
        'cpfCnpj' => 'valid_cnpj',
        'birthdate' => 'valid_date',
        'address' => 'valid_address'
      ]
    ];

    $response = $sut->handle($httpRequest);

    $this->assertEquals($response, new MissingParamError("Missing name"));
  }

  public function testReturnsErrorIfNoCpfCnpjProvided()
  {

    $sut = new RegisterDebtor();

    $httpRequest = [
      'body' => [
        'name' => 'valid_name',
        'birthdate' => 'valid_date',
        'address' => 'valid_address'
      ]
    ];

    $response = $sut->handle($httpRequest);

    $this->assertEquals($response, new MissingParamError("Missing cpfCnpj"));
  }

  public function testReturnsErrorIfNoBirthdateProvided()
  {

    $sut = new RegisterDebtor();

    $httpRequest = [
      'body' => [
        'cpfCnpj' => 'valid_cnpj',
        'name' => 'valid_name',
        'address' => 'valid_address'
      ]
    ];

    $response = $sut->handle($httpRequest);

    $this->assertEquals($response, new MissingParamError("Missing birthdate"));
  }

  public function testReturnsErrorIfNoAddressProvided()
  {

    $sut = new RegisterDebtor();

    $httpRequest = [
      'body' => [
        'name' => 'valid_name',
        'cpfCnpj' => 'valid_cnpj',
        'birthdate' => 'valid_date',
      ]
    ];

    $response = $sut->handle($httpRequest);

    $this->assertEquals($response, new MissingParamError("Missing address"));
  }

  public function testReturnsOkIfAllFieldsProvided()
  {
    $sut = new RegisterDebtor();

    $httpRequest = [
      'body' => [
        'name' => 'valid_name',
        'cpfCnpj' => 'valid_cnpj',
        'birthdate' => 'valid_date',
        'address' => 'valid_address'
      ]
    ];

    $response = $sut->handle($httpRequest);

    $this->assertEquals($response['statusCode'], 200);
    $this->assertEquals($response['body'], [
      'id' => 'valid_id',
      'name' => 'valid_name',
      'cpfCnpj' => 'valid_cnpj',
      'birthdate' => 'valid_date',
      'address' => 'valid_address'
    ]);
  }
}