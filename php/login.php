<?php
$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        if($username == 'user' && $password == 'password') {
            session_start();
            $_SESSION["authenticated"] = 'true';
            header('Location: /home_demo.html');
        }
        else {
            header('Location: /index.html');
        }
        
    } else {
        header('Location: /index.html');
    }
}
?>