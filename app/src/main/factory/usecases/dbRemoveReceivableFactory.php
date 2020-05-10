<?php
declare(strict_types=1);

namespace Main\Factory\UseCases;

use Db\Mysql\ReceivablesMySqlRepository;
use Domain\Usecase\DeleteReceivables;

class DbRemoveReceivableFactory{

  private $receivablesMySqlRepository;

  public function __construct()
  {
    $this->receivablesMySqlRepository = new ReceivablesMySqlRepository();

  }

  public function getReceivablesMySqlRepository(): DeleteReceivables
  {
    return $this->receivablesMySqlRepository;

  }

}