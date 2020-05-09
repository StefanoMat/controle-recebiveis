<?php

declare(strict_types=1);
namespace Db\Mysql;

use Domain\Models\Debt;
use Db\Mysql\MysqlHelper;
use Domain\Usecase\AddDebt;

class DebtMySqlRepository implements AddDebt{

  private $db;

  public function __construct()
  {
    $pdo = new MysqlHelper();
    $this->db = $pdo->getConn();
  }

  public function add(Debt $debt)
  {
    $queryToExecute = $this->db->prepare('insert into debt (debt_title, value, end_date,) values (:debt_title, :value, :end_date)');
    $debtorData = $this->__debtData($debt);

    $queryToExecute->bindParam(':debt_title',$debtorData['debTitle']);
    $queryToExecute->bindParam(':value', $debtorData['value']);
    $queryToExecute->bindParam(':end_date', $debtorData['endDate']);
    $queryToExecute->execute();
    return $this->db->lastInsertId();
  }

  private function __debtData(Debt $debt) {
    return [
      'debtTitle' => $debt->getDebtTitle(),
      'value' => $debt->getValue(),
      'endDate' => $debt->getEndDate()->format('Y-m-d'),
    ];
  }
}