<?php
declare(strict_types=1);

namespace Main\Factory\Controllers;

use Presentation\Controllers\ChangeDebt;
use Main\Factory\UseCases\DbChangeDebtFactory;

class ChangeDebtFactory {

  public function create()
  {
    $dbChangeDebtFactory = new DbChangeDebtFactory();
    $controller = new ChangeDebt($dbChangeDebtFactory->getDebtMysqlRepository());
    return $controller;
  }

}