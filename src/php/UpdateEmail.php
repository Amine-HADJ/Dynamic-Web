<?php
    require_once './Database.php';

    
    $id = $_COOKIE['PHPSESSID'];
    session_id($id);
    session_start();
    if($_SESSION['loggedin'] == true) {
        
        $query_user = $_SESSION['username'];
        //on recupere le mail saisie par l'utilisateur dans le modal twig profile.html.twig
        $query_email = $_POST['confirm-new-email'];
        
        
        $db = new Database('admin');
        $sql = 'UPDATE users SET email = :email WHERE username = :username';
        $sth = $db->conn->prepare($sql);
        $sth->bindValue(':email', $query_email, PDO::PARAM_STR);
        $sth->bindValue(':username', $query_user, PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->rowCount();
        if($result > 0) {

            $result = "L'email a été mis à jour avec succès.";
            echo $result;
            
            



        }
        else {
            $result = "Une erreur s'est produite lors de la mise à jour de l'email.";
            echo $result;
        
        }
    }
?>
    
   

