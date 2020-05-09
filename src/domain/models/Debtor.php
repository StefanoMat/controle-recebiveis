<?php

declare(strict_types=1);

namespace Domain\Models;

use DateTime;

class Debtor{
  private $id;
  private $name;
  private $cpfCnpj;
  private $birthdate;
  private $address;
  private $createdAt;
  private $updatedAt;

  public function __construct(string $name, int $cpfCnpj, DateTime $birthdate, string $address)
  {
    $this->name = $name;
    $this->cpfCnpj = $cpfCnpj;
    $this->birthdate = $birthdate;
    $this->address = $address;
  }

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

  public function getBirthdate(): DateTime
  {
    return $this->birthdate;
  }

  public function getAddress(): string
  {
    return $this->address;
  }

  public function getCreated()
  {
    return $this->createdAt;
  }

  public function getUpdated()
  {
    return $this->updatedAt;
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

  public function setBirthDate(DateTime $birthDate)
  {
    $this->birthDate = $birthDate;
  }

  public function setAddress(string $address)
  {
    $this->address = $address;
  }
}
