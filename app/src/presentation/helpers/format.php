<?php

declare(strict_types=1);

namespace Presentation\Helpers;

use Presentation\Protocols\ResponseInterface;

class Format{

  public function decimal($data)
  {
      $decimal = str_replace('.', '', $data);
      $decimal = str_replace(',', '.', $decimal);
      return $decimal;
  }
}