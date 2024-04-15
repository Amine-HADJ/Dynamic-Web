<?php
    session_start();

    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = 'postgres';
    $password = 'postgres';

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

    if(isset($_POST['new_username']) && isset($_POST['email']) && isset($_POST['new_password'])) {
        $query_user = $_POST['new_username'];
        $query_pass = $_POST['new_password'];
        $query_email = $_POST['email'];

        $check_query = "SELECT count(1) > 0
        FROM users
        WHERE username = '$query_user' OR email = '$query_email'";

        $sth = $conn->prepare( $check_query ); 
        $sth->execute();
        $result = $sth->fetchAll();

        if($result[0]['0']) {
            echo "User already exists";
            $conn = null;
            exit();
        }

        $hashed_password = password_hash($query_pass, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (id, username, email, password) VALUES (default, '$query_user', '$query_email', '$hashed_password')";
        $sth = $conn->query($insert_query);

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $query_user;
        setcookie("user", $query_user, time() + (86400 * 30));

        $conn = null;
        echo "ok";
        exit();
    } else {
        $conn = null;
        echo "Missing details";
        exit();
    }
?>
