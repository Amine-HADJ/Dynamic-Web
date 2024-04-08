<?php
    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $json = file_get_contents('php://input');
    $data_array = json_decode($json, true);

    $query_user = $data_array['username'];
    $query_pass = $data_array['password'];
    $query_email = $data_array['email'];

    $check_query = "SELECT username, password
    FROM users
    WHERE username = $query_user OR email = $query_email";

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

    $sth = $conn->prepare( $check_query ); 
    $sth->execute();
    $result = $sth->fetchAll();

    $conn = null;
    if(password_verify($result['password'], $query_pass)) {
        echo 'ok';
        exit();
    }
    echo 'error';
    exit();

?>
