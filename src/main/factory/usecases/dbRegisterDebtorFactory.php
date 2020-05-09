<?php
declare(strict_types=1);

namespace Main\Factory\UseCases;

use Db\Mysql\DebtorMySqlRepository;
use Domain\Usecase\AddDebtor;

class DbRegisterDebtorFactory{

  private $debtorMySqlRepository;
  public function __construct()
  {
    $this->debtorMySqlRepository = new DebtorMySqlRepository();

  }

  public function getDebtorMysqlRepository(): AddDebtor
  {
    return $this->debtorMySqlRepository;

  }

}