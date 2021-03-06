<?php

declare(strict_types=1);
namespace Db\Mysql;

use Domain\Models\Debt;
use Db\Mysql\MysqlHelper;
use Domain\Usecase\AddDebt;
use Domain\Usecase\UpdateDebt;

class DebtMySqlRepository implements AddDebt, UpdateDebt{

  private $db;

  public function __construct()
  {
    $pdo = new MysqlHelper();
    $this->db = $pdo->getConn();
  }

  public function add(Debt $debt)
  {
    $queryToExecute = $this->db->prepare('INSERT into debts (debtor_id, debt_description, value, end_date) values (:debtor_id, :debt_description, :value, :end_date)');
    $debtorData = $this->__debtData($debt);

    $queryToExecute->bindParam(':debtor_id',$debtorData['debtorId']);
    $queryToExecute->bindParam(':debt_description',$debtorData['debtDescription']);
    $queryToExecute->bindParam(':value', $debtorData['value']);
    $queryToExecute->bindParam(':end_date', $debtorData['endDate']);
    $queryToExecute->execute();
    return $this->db->lastInsertId();
  }

  public function update(Debt $debt)
  {
    $queryToExecute = $this->db->prepare('UPDATE debts SET debtor_id= :debtor_id,debt_description= :debt_description, value= :value,end_date= :end_date WHERE id= :id');
    $debtorData = $this->__debtData($debt, true);

    $queryToExecute->bindParam(':id',$debtorData['id']);
    $queryToExecute->bindParam(':debtor_id',$debtorData['debtorId']);
    $queryToExecute->bindParam(':debt_description',$debtorData['debtDescription']);
    $queryToExecute->bindParam(':value', $debtorData['value']);
    $queryToExecute->bindParam(':end_date', $debtorData['endDate']);
    $queryToExecute->execute();
    return $queryToExecute->rowCount();
  }

  private function __debtData(Debt $debt, $withId = false) {
    return [
      'id' => $withId ? $debt->getId() : 0,
      'debtorId' => $debt->getDebtorId(),
      'debtDescription' => $debt->getDebtDescription(),
      'value' => $debt->getValue(),
      'endDate' => $debt->getEndDate()->format('Y-m-d'),
    ];
  }
}