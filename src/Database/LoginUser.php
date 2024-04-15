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

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $query_user = $_POST['username'];
        $query_pass = $_POST['password'];

        $check_query = "SELECT *
        FROM users
        WHERE username = '$query_user' OR email = '$query_user'";

        $sth = $conn->prepare( $check_query ); 
        $sth->execute();
        $result = $sth->fetchAll();
        $conn = null;

        if($result){
            $result = $result[0];
            if(password_verify($query_pass, $result['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $query_user;
                setcookie("user", $query_user, time() + (86400 * 30));
    
                echo 'ok';
                exit();
            }
            echo "pass error";
            exit();
        } else {
            echo 'error';
            exit();
        }
    }
?>
