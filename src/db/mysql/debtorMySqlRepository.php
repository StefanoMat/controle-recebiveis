<?php

declare(strict_types=1);
namespace Db\Mysql;

use Domain\Models\Debtor;
use Domain\Usecase\AddDebtor;
use Db\Mysql\MysqlHelper;

class DebtorMySqlRepository implements AddDebtor{

  private $db;

  public function __construct()
  {
    $pdo = new MysqlHelper();
    $this->db = $pdo->getConn();
  }

  public function add(Debtor $debtor)
  {
    $queryToExecute = $this->db->prepare('insert into debtors (name, cpf_cnpj, birthdate, address) values (:name, :cpfCnpj, :birthdate, :address)');
    $debtorData = $this->__debtorData($debtor);

    $queryToExecute->bindParam(':name',$debtorData['name']);
    $queryToExecute->bindParam(':cpfCnpj', $debtorData['cpfCnpj']);
    $queryToExecute->bindParam(':birthdate', $debtorData['birthdate']);
    $queryToExecute->bindParam(':address', $debtorData['address']);
    $queryToExecute->execute();
    return $this->db->lastInsertId();
  }

  private function __debtorData(Debtor $debtor) {
    return [
      'name' => $debtor->getName(),
      'cpfCnpj' => $debtor->getCpfCnpj(),
      'birthdate' => $debtor->getBirthdate()->format('Y-m-d'),
      'address' => $debtor->getAddress()
    ];
  }
}