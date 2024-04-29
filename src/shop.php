<?php
    // index.php
    require_once './vendor/autoload.php';
    require_once './php/database.php';
    require "./php/CheckLogin.php";
    
    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    $db = new Database();
    $data = $db->getProducts();

    echo $twig->render("shop.html.twig", ['elements' => $data, 'loggedin' => $loggedin]);