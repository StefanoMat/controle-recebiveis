<?php

declare(strict_types=1);
namespace Db\Mysql;

use Domain\Models\Debtor;
use Domain\Usecase\AddDebtor;
use Db\Mysql\MysqlHelper;
use Domain\Usecase\UpdateDebtor;

class DebtorMySqlRepository implements AddDebtor, UpdateDebtor{

  private $db;

  public function __construct()
  {
    $pdo = new MysqlHelper();
    $this->db = $pdo->getConn();
  }

  public function add(Debtor $debtor)
  {
    $queryToExecute = $this->db->prepare('INSERT into debtors (name, cpf_cnpj, birthdate, address) values (:name, :cpfCnpj, :birthdate, :address)');
    $debtorData = $this->__debtorData($debtor);

    $queryToExecute->bindParam(':name',$debtorData['name']);
    $queryToExecute->bindParam(':cpfCnpj', $debtorData['cpfCnpj']);
    $queryToExecute->bindParam(':birthdate', $debtorData['birthdate']);
    $queryToExecute->bindParam(':address', $debtorData['address']);
    $queryToExecute->execute();
    return $this->db->lastInsertId();
  }

  public function update(Debtor $debtor)
  {
    $queryToExecute = $this->db->prepare('UPDATE debtors SET name= :name,cpf_cnpj= :cpf_cnpj, birthdate= :birthdate, address= :address WHERE id= :id');
    $debtorData = $this->__debtorData($debtor, true);

    $queryToExecute->bindParam(':id',$debtorData['id']);
    $queryToExecute->bindParam(':name',$debtorData['name']);
    $queryToExecute->bindParam(':cpf_cnpj',$debtorData['cpfCnpj']);
    $queryToExecute->bindParam(':birthdate', $debtorData['birthdate']);
    $queryToExecute->bindParam(':address', $debtorData['address']);
    $queryToExecute->execute();
    return $queryToExecute->rowCount();
  }

  private function __debtorData(Debtor $debtor, $withId = false) {
    return [
      'id' => $withId ? $debtor->getId() : 0,
      'name' => $debtor->getName(),
      'cpfCnpj' => $debtor->getCpfCnpj(),
      'birthdate' => $debtor->getBirthdate()->format('Y-m-d'),
      'address' => $debtor->getAddress()
    ];
  }
}