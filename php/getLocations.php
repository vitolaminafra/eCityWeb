<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";

    $conn = new mysqli($servername, $username, $password, "my_ecity");
    if(!$conn) {
        die("Not connected");
    }

    $lat = $_GET["lat"];
    $lng = $_GET["lng"];

    $sid = $_GET["sid"];

    $sql = "SELECT * FROM servizio WHERE sid = '".$sid."'";
    $result = $conn->query($sql);

    $locations = array();

    if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
        $loc = array("sid" => $row["sid"], "lat" => $row["lat"], "lng" => $row["lng"], "type" => $row["tipo"]);
    } 

    echo json_encode($loc);

?>