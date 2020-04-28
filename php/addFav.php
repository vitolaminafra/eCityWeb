<?php
    require 'db.php';

    $sid = $_POST["sid"];

    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }

    $sql = "INSERT INTO preferito(uid, sid) VALUES($uid, $sid)";
    $conn->query($sql);

    header('Location: /home.php?newFav');



?>