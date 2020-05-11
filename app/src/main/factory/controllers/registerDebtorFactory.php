<?php
declare(strict_types=1);

namespace Main\Factory\Controllers;

use Main\Factory\UseCases\DbRegisterDebtorFactory;
use Presentation\Controllers\RegisterDebtor;

class RegisterDebtorFactory {

  public function create()
  {
    $dbRegisterFactory = new DbRegisterDebtorFactory();
    $controller = new RegisterDebtor($dbRegisterFactory->getDebtorMysqlRepository());
    return $controller;
  }

}
