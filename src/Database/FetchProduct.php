<?php
    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $query = $_GET['query'];

    $sql = "SELECT * FROM products WHERE id = $query"; 

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

    $sth = $conn->prepare( $sql ); 
    $sth->execute();
    $element = $sth->fetchAll();
    $conn = null;
    echo json_encode($element);
?>