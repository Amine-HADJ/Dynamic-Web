<?php
    require_once './Database.php';

    $db = new Database();

    header('Content-Type: application/json');
    $query = $_GET['query'];

    $sql = "SELECT *
            FROM products
            WHERE title LIKE '%$query%'
        "; 
    $sth = $db->conn->prepare( $sql ); 
    $sth->execute();
    $elements = $sth->fetchAll();

    echo json_encode($elements);
?>