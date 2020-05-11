<?php
declare(strict_types=1);

namespace Main\Factory\Controllers;

use Presentation\Controllers\RegisterDebt;
use Main\Factory\UseCases\DbRegisterDebtFactory;

class RegisterDebtFactory {

  public function create()
  {
    $dbRegisterFactory = new DbRegisterDebtFactory();
    $controller = new RegisterDebt($dbRegisterFactory->getDebtMysqlRepository());
    return $controller;
  }

}