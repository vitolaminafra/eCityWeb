<?php
    require ('db.php');
    
    $sid = $_GET["sid"];

    $sql = "SELECT * FROM servizio WHERE sid = '".$sid."'";
    $result = $conn->query($sql);

    $locations = array();

    if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
        $loc = array("sid" => $row["sid"], "lat" => $row["lat"], "lng" => $row["lng"], "type" => $row["tipo"], "ind" => $row['indirizzo']);
    } 

    echo json_encode($loc);

?>