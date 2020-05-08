<?php

namespace Db\Mysql;
use PDO;

class MysqlHelper {

  private $conn;

  public function __construct()
  {
      if (!$this->conn) {
        try {
          $this->conn = new PDO('mysql:host=localhost;port=3308;dbname=saas_recebiveis', 'root', '');
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
      }
  }

  public function getConn() {
    return $this->conn;
  }
}