<?php

declare(strict_types=1);
namespace Db\Mysql;

use Db\Mysql\MysqlHelper;
use Domain\Usecase\DeleteReceivables;
use Domain\Usecase\GetReceivables;

class ReceivablesMySqlRepository implements GetReceivables, DeleteReceivables{

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
    $debts = $queryToExecute->fetchAll(\PDO::FETCH_ASSOC);
    $queryToExecute = $this->db->prepare('SELECT SUM(value) total, sum(IF(CHAR_LENGTH(debtors.cpf_cnpj) < 12, value, 0)) fisica, sum(IF(CHAR_LENGTH(debtors.cpf_cnpj) > 11, value, 0)) juridica FROM debts left OUTER join debtors on debtors.id = debtor_id');
    $queryToExecute->execute();
    $totals = $queryToExecute->fetchAll(\PDO::FETCH_ASSOC);
    $queryToExecute = $this->db->prepare('SELECT debtors.*, debts.value FROM debts inner join debtors on debtors.id = debtor_id group by debtors.id order by value DESC limit 3');
    $queryToExecute->execute();
    $topDebtors = $queryToExecute->fetchAll(\PDO::FETCH_ASSOC);

    $result = [
      'debts' => $debts,
      'totals' => $totals,
      'top_debtors' => $topDebtors
    ];
    return $result;
  }

  public function delete(int $debtorId, int $debtId)
  {
    $queryToExecute = $this->db->prepare('DELETE FROM debts where id = :debt_id');
    $queryToExecute->bindParam(':debt_id' ,$debtId);
    $queryToExecute->execute();

    $queryToExecute = $this->db->prepare('DELETE FROM debtors where id = :debtor_id');
    $queryToExecute->bindParam(':debtor_id', $debtorId);
    $queryToExecute->execute();

    return $queryToExecute->rowCount();
  }
}