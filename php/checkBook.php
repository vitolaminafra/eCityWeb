<?php
    require ('db.php');
    $sid = $_GET["sid"];

    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }

    $sql = "SELECT * FROM prenotazione WHERE attivo = 'true' AND sid = $sid";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row['uid'] == $uid) {
            $return = "Cancella";
        } else {
            $return = "Non disp.";
        }
    } else {
        $return = "Prenota";
    }

    echo $return;


?>