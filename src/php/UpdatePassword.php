<?php
    require_once './Database.php';

    
    $id = $_COOKIE['PHPSESSID'];
    session_id($id);
    session_start();
    if($_SESSION['loggedin'] == true) {
        
        $query_user = $_SESSION['username'];
        //on recupere le mot de passe saisie par l'utilisateur dans le modal twig profile.html.twig
        $query_pass = $_POST['confirm-new-password'];
        //on hash le mot de passe
        $query_pass = password_hash($query_pass, PASSWORD_DEFAULT);
        
        $db = new Database('admin');
        $sql = 'UPDATE users SET password = :password WHERE username = :username';
        $sth = $db->conn->prepare($sql);
        $sth->bindValue(':password', $query_pass, PDO::PARAM_STR);
        $sth->bindValue(':username', $query_user, PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->rowCount();
        if($result > 0) {

            $result = "Le mot de passe a été mis à jour avec succès.";
            echo $result;
            
            



        }
        else {
            $result = "Une erreur s'est produite lors de la mise à jour du mot de passe.";
            echo $result;
        
        }
    }
?>
    
   

