<?
   
    require './php/Database.php';
    $data = [];

    if($_SESSION['loggedin'] == true) {
        
        $db = new Database();
        $username = $_SESSION['username'];
        $sql = 'SELECT username, email FROM users WHERE username = :username';
        $sth =  $db->conn->prepare($sql);
        $sth->bindValue(':username', PDO::PARAM_STR);
        $sth->execute([':username' => $username]);
        $user_data= $sth->fetch();
        
        }

    else {
        
        echo 'No username or password provided';
    }

?>