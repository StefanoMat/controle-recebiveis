<?php
declare(strict_types=1);

namespace Presentation\Controllers;

use Presentation\Errors\MissingParamError;
use Presentation\Protocols\Controller;

class RegisterDebtor implements Controller{

  public function handle($htppRequest)
  {
    try{
    $requiredFields = ['name','cpfCnpj','birthdate', 'address'];
    foreach ($requiredFields as $field) {
      if(!isset($htppRequest['body'][$field])) {
        return new MissingParamError("Missing ".$field);
      }
    }

    } catch(\Error $e) {

    }
  }
  

}