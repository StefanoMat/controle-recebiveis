<?php
declare(strict_types=1);

namespace Main\Factory\UseCases;

use Db\Mysql\DebtMySqlRepository;
use Domain\Usecase\AddDebt;

class DbRegisterDebtFactory{

  private $debtMySqlRepository;
  public function __construct()
  {
    $this->debtMySqlRepository = new DebtMySqlRepository();

  }

  public function getDebtMysqlRepository(): AddDebt
  {
    return $this->debtMySqlRepository;

  }

}