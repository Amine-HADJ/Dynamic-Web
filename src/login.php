<?php
    // index.php
    require_once './vendor/autoload.php';
    require_once './php/Database.php';
    require "./php/CheckSession.php";
    
    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    $db = new Database();
    $data = $db->getData();

    echo $twig->render("login.html.twig", ['loggedin' => $loggedin]);