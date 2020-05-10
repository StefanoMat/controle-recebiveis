<?php

declare(strict_types=1);

namespace Domain\Usecase;

use Domain\Models\Debtor;

interface UpdateDebtor{

  public function update(Debtor $debtor);
  
}