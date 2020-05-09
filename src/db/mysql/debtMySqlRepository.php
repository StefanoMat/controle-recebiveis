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
    $queryToExecute = $this->db->prepare('insert into debt (debtor_id, debt_description, value, end_date) values (:debtor_id, :debt_description, :value, :end_date)');
    $debtorData = $this->__debtData($debt);

    $queryToExecute->bindParam(':debtor_id',$debtorData['debtorId']);
    $queryToExecute->bindParam(':debt_description',$debtorData['debtDescription']);
    $queryToExecute->bindParam(':value', $debtorData['value']);
    $queryToExecute->bindParam(':end_date', $debtorData['endDate']);
    $queryToExecute->execute();
    return $this->db->lastInsertId();
  }

  private function __debtData(Debt $debt) {
    return [
      'debtorId' => $debt->getDebtorId(),
      'debtDescription' => $debt->getDebtDescription(),
      'value' => $debt->getValue(),
      'endDate' => $debt->getEndDate()->format('Y-m-d'),
    ];
  }
}