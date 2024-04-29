<?php
    // index.php
    require_once './vendor/autoload.php';
    require_once './php/Database.php';
    require "./php/CheckLogin.php";

    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    $db = new Database();
    $data = $db->getCart();

    echo $twig->render("cart.html.twig", ['elements' => $data, 'user' => $user, 'loggedin' => $loggedin]);

