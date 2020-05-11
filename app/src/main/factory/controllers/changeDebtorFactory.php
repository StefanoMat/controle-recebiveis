<?php
declare(strict_types=1);

namespace Main\Factory\Controllers;

use Presentation\Controllers\ChangeDebtor;
use Main\Factory\UseCases\DbChangeDebtorFactory;

class ChangeDebtorFactory {

  public function create()
  {
    $dbChangeDebtorFactory = new DbChangeDebtorFactory();
    $controller = new ChangeDebtor($dbChangeDebtorFactory->getDebtorMysqlRepository());
    return $controller;
  }

}