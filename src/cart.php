<?php
    // index.php
    require_once './vendor/autoload.php';
    require_once './php/Database.php';
    require "./php/CheckLogin.php";

    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    $db = new Database();
    $data = $db->getCart();

    // On récupère le prix de chaque élement du panier pour calculer le total ($data[i]['price'] est de la forme $00.00 )
    $total = 0; 
    foreach ($data as $element) {
        $total += floatval(substr($element['price'], 1));
    }
    echo $twig->render("cart.html.twig", ['elements' => $data, 'user' => $user, 'loggedin' => $loggedin, 'total' => $total]);

