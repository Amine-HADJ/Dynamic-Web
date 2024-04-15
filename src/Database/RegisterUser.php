<?php
    session_start();

    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

    if(isset($_POST['username']) && isset() && isset($_POST['password'])) {
        $query_user = $_POST['username'];
        $query_pass = $_POST['password'];
        $query_email = $_POST['email'];

        $check_query = "SELECT count(1) > 0
        FROM users
        WHERE username = $query_user OR email = $query_email";

        $sth = $conn->prepare( $check_query ); 
        $sth->execute();
        $result = $sth->fetchAll();

        if($result[0]) {
            echo "User already exists";
            $conn = null;
            exit();
        }

        $hashed_password = password_hash($query_pass, "");
        $insert_query = "INSERT INTO users (username, email, password) VALUES ($query_user, $query_email, $hashed_password)";
        $sth = $conn->prepare($insert_query);
        $conn = null;
        echo "ok";
        exit();
    }
?>
