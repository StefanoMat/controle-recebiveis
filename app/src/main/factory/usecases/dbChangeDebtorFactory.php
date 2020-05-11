<?php
declare(strict_types=1);

namespace Main\Factory\UseCases;

use Db\Mysql\DebtorMySqlRepository;
use Domain\Usecase\UpdateDebtor;

class DbChangeDebtorFactory{

  private $debtorMySqlRepository;
  public function __construct()
  {
    $this->debtorMySqlRepository = new DebtorMySqlRepository();

  }

  public function getDebtorMysqlRepository(): UpdateDebtor
  {
    return $this->debtorMySqlRepository;

  }

}