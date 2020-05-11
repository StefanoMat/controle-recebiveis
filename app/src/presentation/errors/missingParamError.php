<?php

declare(strict_types=1);

namespace Presentation\Errors;

use Exception;

class MissingParamError extends Exception {
  public function __construct(string $param)
  {
    parent::__construct('Missing '.$param);
  }
}
