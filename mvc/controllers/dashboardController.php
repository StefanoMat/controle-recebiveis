<?php
declare(strict_types=1);

namespace Mvc\Controllers;

use Mvc\Core\Controller;

class DashboardController extends Controller{

  public function index()
  {
    $this->render('index');
  }
}