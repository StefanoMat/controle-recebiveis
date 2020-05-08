<?php
declare(strict_types=1);

namespace Main\Factory\UseCases;

use Domain\Usecase\AddDebtor;
use Db\Mysql\DebtorMySqlRepository;

class DbRegisterDebtorFactory{

  private $debtorMySqlRepository;
  public function __construct()
  {
    $this->debtorMySqlRepository = new DebtorMySqlRepository();

  }

  public function getDebtorMysqlRepository()
  {
    return $this->debtorMySqlRepository;

  }

}