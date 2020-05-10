<?php
declare(strict_types=1);

namespace Main\Factory\UseCases;

use Db\Mysql\ReceivablesMySqlRepository;
use Domain\Usecase\GetReceivables;

class DbLoadReceivablesFactory{

  private $receivablesMySqlRepository;

  public function __construct()
  {
    $this->receivablesMySqlRepository = new ReceivablesMySqlRepository();

  }

  public function getReceivablesMySqlRepository(): GetReceivables
  {
    return $this->receivablesMySqlRepository;

  }

}