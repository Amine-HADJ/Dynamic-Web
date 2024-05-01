<?php
    require_once './Database.php';
    session_start();
    
    $db = new Database();

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $query_user = $_POST['username'];
        $query_pass = $_POST['password'];

        $check_query = "SELECT *
            FROM users
            WHERE username = :query_user OR email = :query_email";

        $sth = $db->conn->prepare($check_query);
        $sth->bindValue(':query_user', $query_user, PDO::PARAM_STR);
        $sth->bindValue(':query_email', $query_user, PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->fetchAll();
        
        if($result){
            $result = $result[0];
            if(password_verify($query_pass, $result['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $query_user;
                setcookie("user", $query_user, time() + (86400 * 30));
    
                header('Location: ../index.php');
                exit();
            } else {
                header('Location: ../login.php');
                exit();
            }
        } else {
            header('Location: ../login.php');
            exit();
        }
    }
?>
