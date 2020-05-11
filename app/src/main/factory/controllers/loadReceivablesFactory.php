<?php
declare(strict_types=1);

namespace Main\Factory\Controllers;

use Presentation\Controllers\LoadReceivables;
use Main\Factory\UseCases\DbLoadReceivablesFactory;

class LoadReceivablesFactory {

  public function create()
  {
    $dbLoadReceivablesFactory = new DbLoadReceivablesFactory();
    $controller = new LoadReceivables($dbLoadReceivablesFactory->getReceivablesMySqlRepository());
    return $controller;
  }

}