<?php
    require_once './vendor/autoload.php';
    require "./php/CheckLogin.php";
    require "./php/FetchUserData.php";

    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);
    

    
    echo $twig->render("profile.html.twig", ['user_email' => $user_data['email'], 'user' => $user, 'loggedin' => $loggedin]);
?>