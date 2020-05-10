<?php
declare(strict_types=1);

namespace Main\Factory\Controllers;

use Presentation\Controllers\RemoveReceivable;
use Main\Factory\UseCases\DbLoadReceivablesFactory;

class RemoveReceivableFactory {

  public function create()
  {
    $dbLoadReceivablesFactory = new DbLoadReceivablesFactory();
    $controller = new RemoveReceivable($dbLoadReceivablesFactory->getReceivablesMySqlRepositoryToDelete());
    return $controller;
  }

}