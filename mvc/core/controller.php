<?php
declare(strict_types=1);

namespace Mvc\Core;

class Controller {

  function render($view, $folder = '' )
  {
    require BASE . "/views/" . $folder. $view . '.php';
  }
}