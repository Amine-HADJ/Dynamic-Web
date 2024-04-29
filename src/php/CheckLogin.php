<?php
    session_start();
    $loggedin = true;
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        $loggedin = false;
        header('Location: login.php');
        exit;
    }
?>