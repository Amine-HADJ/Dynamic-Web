<?php
    // index.php
    require_once './vendor/autoload.php';
    require_once './Database/database.php';

    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    $db = new Database();
    $data = $db->getData();

    echo $twig->render("shop.html.twig");