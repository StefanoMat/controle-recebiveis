<?php

declare(strict_types=1);

namespace Domain\Models;

use DateTime;

class Debt{
  private $id;
  private $debtTitle;
  private $value;
  private $endDate;
  private $createdAt;
  private $updatedAt;

  public function __construct(string $debtTitle, float $value, DateTime $endDate)
  {
    $this->debtTitle = $debtTitle;
    $this->value = $value;
    $this->endDate = $endDate;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getDebtTitle(): string
  {
    return $this->debtTitle;
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