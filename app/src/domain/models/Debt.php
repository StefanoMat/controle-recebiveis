<?php

declare(strict_types=1);

namespace Domain\Models;

use DateTime;

class Debt{
  private $id;
  private $debtorId;
  private $debtDescription;
  private $value;
  private $endDate;
  private $createdAt;
  private $updatedAt;

  public function __construct(int $debtorId, string $debtDescription, float $value, DateTime $endDate)
  {
    $this->debtorId = $debtorId;
    $this->debtDescription = $debtDescription;
    $this->value = $value;
    $this->endDate = $endDate;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getDebtorId(): int
  {
    return $this->debtorId;
  }

  public function getDebtDescription(): string
  {
    return $this->debtDescription;
  }

  public function getValue(): float
  {
    return $this->value;
  }

  public function getEndDate(): DateTime
  {
    return $this->endDate;
  }

  public function getCreated(): DateTime
  {
    return $this->createdAt;
  }

  public function getUpdated(): DateTime
  {
    return $this->updatedAt;
  }
}