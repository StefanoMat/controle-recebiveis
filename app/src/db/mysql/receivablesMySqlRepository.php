<?php

declare(strict_types=1);
namespace Db\Mysql;

use Db\Mysql\MysqlHelper;
use Domain\Usecase\GetReceivables;

class ReceivablesMySqlRepository implements GetReceivables{

  private $db;

  public function __construct()
  {
    $pdo = new MysqlHelper();
    $this->db = $pdo->getConn();
  }

  public function get()
  {
    $queryToExecute = $this->db->prepare('SELECT * FROM debts inner join debtors on debtor_id = debtors.id');


    $queryToExecute->execute();
    return $queryToExecute->fetchAll(\PDO::FETCH_ASSOC);
  }
}