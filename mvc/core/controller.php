<?php
declare(strict_types=1);

namespace Mvc\Core;

class Controller {

  function render($view, $folder = '', $data = null )
  {
    $data ? extract($data) : '';
    require BASE . "/views/" . $folder. $view . '.php';
  }
}