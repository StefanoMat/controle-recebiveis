<?php

declare(strict_types=1);

namespace Presentation\Errors;

use Exception;

class ServerError extends Exception {
  public function __construct()
  {
    parent::__construct('Server error occurred');
  }
}
