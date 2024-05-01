<?php
    require_once './Database.php';

    $db = new Database();
    $query = $_GET['query'];

    $sql = "SELECT * FROM products WHERE id = :id"; 

    $sth = $db->conn->prepare($sql);
    $sth->bindValue(':id', $query, PDO::PARAM_INT);
    $sth->execute();
    $element = $sth->fetchAll();
    
    echo json_encode($element);
?>