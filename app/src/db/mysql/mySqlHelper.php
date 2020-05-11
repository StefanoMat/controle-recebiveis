<?php

namespace Db\Mysql;
use PDO;

class MysqlHelper {

  private $conn;

  public function __construct()
  {
      if (!$this->conn) {
        try {
          $this->conn = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
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