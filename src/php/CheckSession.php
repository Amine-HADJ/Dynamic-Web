<?php
    if(session_id() == '') {
        session_start();
    }
    $loggedin = true;
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        $loggedin = false;
        $user = null;
    }
?>