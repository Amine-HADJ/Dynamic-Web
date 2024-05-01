<?php
    require_once './Database.php';

    session_start();
    $db = new Database("admin");

    if(isset($_POST['new_username']) && isset($_POST['email']) && isset($_POST['new_password'])) {
        $query_user = $_POST['new_username'];
        $query_pass = $_POST['new_password'];
        $query_email = $_POST['email'];

        $check_query = "SELECT COUNT(1) > 0
            FROM users
            WHERE username = :username OR email = :email";

        $sth = $db->conn->prepare($check_query);
        $sth->bindValue(':username', $query_user, PDO::PARAM_STR);
        $sth->bindValue(':email', $query_email, PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->fetchAll();

        if($result[0]['0']) {
            header('Location: ../login.php');
            exit();
        }

        $hashed_password = password_hash($query_pass, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (id, username, email, password) VALUES (default, :username, :email, :password)";

        $sth = $db->conn->prepare($insert_query);

        $sth->bindValue(':username', $query_user, PDO::PARAM_STR);
        $sth->bindValue(':email', $query_email, PDO::PARAM_STR);
        $sth->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $sth->execute();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $query_user;
        setcookie("user", $query_user, time() + (86400 * 30));

        header('Location: ../index.php');
        exit();
    } else {
        header('Location: ../login.php');
        exit();
    }
?>
