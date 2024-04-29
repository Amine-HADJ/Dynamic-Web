<?php
    require_once './Database.php';

    $db = new Database();
    $query = $_GET['query'];

    $sql = "SELECT * FROM products WHERE id = $query"; 

    $sth = $db->conn->prepare($sql);
    $sth->execute();
    $element = $sth->fetchAll();
    
    echo json_encode($element);
?>