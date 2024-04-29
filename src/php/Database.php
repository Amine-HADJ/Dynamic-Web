<?php
// src/Database/database.php
class Database {
    private $host;
    private $port = '5432';
    private $dbname;
    private $user;
    private $password;
    public $conn;

    public function __construct($type = null) {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_DB'];
        $this->user = $type == "admin" ? $_ENV['DB_ADMIN_USER'] : $_ENV['DB_USER'];
        $this->password = $type == "admin" ? $_ENV['DB_ADMIN_PASSWORD'] : $_ENV['DB_PASSWORD'];
      try {
          $this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->password);
      } catch (PDOException $e) {
          echo $e->getCode() . ' ' . $e->getMessage();
      }
    }

    public function getData() {
        $sql = 'SELECT nom AS meridian_name FROM meridien ORDER BY nom;'; 
        $sth = $this->conn->prepare( $sql ); 
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getProducts() {
        $sql = 'SELECT * FROM products;'; 
        $sth = $this->conn->prepare( $sql ); 
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getCart() {
        $cart = $_COOKIE['cart'] ?? '[]';
        $cart = json_decode($cart, true);
    
        $products = [];
    
        foreach ($cart as $id) {
            $sql = 'SELECT * FROM products WHERE id = ?';
            $sth = $this->conn->prepare($sql);
            $sth->execute([$id]);
            $product = $sth->fetch();
            $products[] = $product;
            
        }
        
        return $products;
    }
    

}
