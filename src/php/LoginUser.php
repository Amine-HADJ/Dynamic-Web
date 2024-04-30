<?php
    require_once './Database.php';

    $db = new Database();

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $query_user = $_POST['username'];
        $query_pass = $_POST['password'];

        $check_query = "SELECT *
            FROM users
            WHERE username = '$query_user' OR email = '$query_user'";

        $sth = $db->conn->prepare( $check_query ); 
        $sth->execute();
        $result = $sth->fetchAll();
        
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
