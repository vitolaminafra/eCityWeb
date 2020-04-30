<?php
    require_once 'db.php';

    $sid = $_POST["sid"];

    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }


    $sql = "INSERT INTO prenotazione(uid, sid) VALUES($uid, $sid)";
    $conn->query($sql);

    header('Location: /home.php?newBook');



?>