<?php

declare(strict_types=1);

namespace Domain\Usecase;
use Domain\Models\Debt;

interface AddDebt{

  public function add(Debt $debt);
  
}