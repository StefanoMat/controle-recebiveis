<?php

declare(strict_types=1);

namespace Domain\Models;

class Debtor{
  private $id;
  private $name;
  private $cpfCnpj;
  private $birthdate;
  private $address;

  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getCpfCnpj(): int
  {
    return $this->cpfCnpj;
  }

  public function getBirthdate()
  {
    return $this->birthdate;
  }

  public function getAddress(): string
  {
    return $this->address;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function setCpfCnpj(int $cpfCnpj)
  {
    $this->cpfCnpj = $cpfCnpj;
  }

  public function setBirthDate($birthDate)
  {
    $this->birthDate = $birthDate;
  }

  public function setAddress(string $address)
  {
    $this->address = $address;
  }
}
