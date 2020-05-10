<?php

declare(strict_types=1);

namespace Domain\Usecase;

use Domain\Models\Debt;

interface UpdateDebt{

  public function update(Debt $debt);
  
}