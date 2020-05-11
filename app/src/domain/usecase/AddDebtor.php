<?php

declare(strict_types=1);

namespace Domain\Usecase;
use Domain\Models\Debtor;

interface AddDebtor{

  public function add(Debtor $debtor);
  
}