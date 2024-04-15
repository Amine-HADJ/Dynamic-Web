<?php
    // index.php
    require_once './vendor/autoload.php';
    require_once './Database/Database.php';

    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    $db = new Database();
    $data = $db->getData();

    echo $twig->render("search.html.twig", ['elements' => $data]);