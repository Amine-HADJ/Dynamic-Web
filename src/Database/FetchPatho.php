<?php
// src/Database/database.php
class Database {
    private $host;
    private $port = '5432';
    private $dbname;
    private $user;
    private $password;
    private $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_DB'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
      try {
          $this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->password);
      } catch (PDOException $e) {
          echo $e->getCode() . ' ' . $e->getMessage();
      }
    }

    public function getData() {
        $sql = 'SELECT m.nom AS meridian_name, p.desc AS pathology_description FROM meridien m JOIN patho p ON m.code = p.mer WHERE m.nom = ?;'; 
        $sth = $this->conn->prepare( $sql ); 
        $sth->execute();
        return $sth->fetchAll();
    }
}
