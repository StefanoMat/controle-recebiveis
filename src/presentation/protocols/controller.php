<?php

declare(strict_types=1);

namespace Presentation\Protocols;

interface Controller {
  public function handle($httpRequest);
}