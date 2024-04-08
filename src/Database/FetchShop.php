<?php
    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $sql = 'SELECT * FROM products'; 

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

    $sth = $this->conn->prepare( $sql ); 
    $sth->execute();
    $elements = $sth->fetchAll();
    $conn = null;
    echo json_encode($elements);
?>