<?php

use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\ChangeDebtor;
use Presentation\Errors\MissingParamError;


class ChangeDebtororTest extends TestCase {

  public function testReturnsErrorIfNoIdProvided()
  {
    $sut = new ChangeDebtor();
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

}