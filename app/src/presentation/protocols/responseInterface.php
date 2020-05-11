<?php

declare(strict_types=1);

namespace Presentation\Protocols;

interface ResponseInterface {

  public function getStatusCode(): int;

  public function getBody();

  public function withStatus(int $statusCode);

  public function withBody($body);

}
