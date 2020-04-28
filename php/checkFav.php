<?php
    require ('db.php');
    $sid = $_GET["sid"];

    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }

    $sql = "SELECT * FROM preferito WHERE uid = $uid AND sid = $sid";
    $result = $conn->query($sql);

    echo $result->num_rows;


?>