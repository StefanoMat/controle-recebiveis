<?php

declare(strict_types=1);

namespace Presentation\Helpers;

use Presentation\Protocols\ResponseInterface;

class HttpResponse implements ResponseInterface{

  private $statusCode;
  private $body;

  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  public function getBody()
  {
    return $this->body;
  }

  public function withStatus(int $statusCode)
  {
    $this->statusCode = $statusCode;
  }

  public function withBody($body = '')
  {
    $this->body = $body;
  }

}