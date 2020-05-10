<?php

use Presentation\Errors\MissingParamError;
use \PHPUnit\Framework\TestCase;
use Presentation\Controllers\RemoveReceivable;

class RemoveReceivableTest extends TestCase{

  public function testReturnsErrorIfNoIdProvided()
  {
    $sut = new RemoveReceivable();

    $httpRequest = [];
    $response = $sut->handle($httpRequest);
    $this->assertEquals($response->getBody(), new MissingParamError("id"));
  }
}