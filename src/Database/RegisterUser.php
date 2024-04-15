<?php
    require_once './Database.php';

    session_start();
    $db = new Database("admin");

    if(isset($_POST['new_username']) && isset($_POST['email']) && isset($_POST['new_password'])) {
        $query_user = $_POST['new_username'];
        $query_pass = $_POST['new_password'];
        $query_email = $_POST['email'];

        $check_query = "SELECT count(1) > 0
            FROM users
            WHERE username = '$query_user' OR email = '$query_email'";

        $sth = $db->conn->prepare( $check_query ); 
        $sth->execute();
        $result = $sth->fetchAll();

        if($result[0]['0']) {
            echo "User already exists";
            exit();
        }

        $hashed_password = password_hash($query_pass, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (id, username, email, password) VALUES (default, '$query_user', '$query_email', '$hashed_password')";
        $sth = $db->conn->query($insert_query);

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $query_user;
        setcookie("user", $query_user, time() + (86400 * 30));

        echo "ok";
        exit();
    } else {
        echo "Missing details";
        exit();
    }
?>
