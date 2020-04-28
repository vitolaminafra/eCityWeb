<?php
    require 'db.php';

    $sid = $_POST["sid"];

    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }

    $sql = "DELETE FROM preferito WHERE uid = $uid AND sid = $sid";
    $conn->query($sql);

    echo $sql;

    header('Location: /home.php?remFav');



?>