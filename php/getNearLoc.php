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

        $latitudeFrom = $lat;
        $longitudeFrom = $lng;

        $latitudeTo = $row["lat"];
        $longitudeTo = $row["lng"];

        $theta = $longitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = ($miles * 1609.344);

        $loc = array("sid" => $row["sid"], "lat" => $row["lat"], "lng" => $row["lng"], "type" => $row["tipo"], "distance" => round($distance));
    } 

    echo json_encode($loc);

?>