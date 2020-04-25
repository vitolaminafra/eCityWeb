<?php
    session_start();
    if(isset($_SESSION["logged"])) {
        session_destroy();
        header('Location: /');
    }
    if(isset($_COOKIE["logged"])) {
        session_destroy();
        echo "qua";
        setcookie("logged", "", time() - 3600, "/");
        header('Location: /');
    }
?>