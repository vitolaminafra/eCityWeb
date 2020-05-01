<?php

require ('db.php');

$lat = 41.108205;
$lng = 16.878231;

if(isset($_SESSION["logged"])) {
    $sql = "SELECT * FROM preferito WHERE uid = ".$_SESSION["logged"];  
  } else {
    $sql = "SELECT * FROM preferito WHERE uid = ".$_COOKIE["logged"];
  }

$result = $conn->query($sql);

$favs = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sid = $row["sid"];
        $sql = "SELECT * FROM servizio WHERE sid = $sid";
        $serRes = $conn->query($sql);
        $serRow = $serRes->fetch_assoc();
        $distance = getDis($lat, $lng, $serRow["lat"], $serRow["lng"]);
        $loc = array("sid" => $sid, "lat" => $serRow["lat"], "lng" => $serRow["lng"], 
            "type" => $serRow["tipo"], "ind" => $serRow["indirizzo"], "distance" => round($distance));
        array_push($favs, $loc);
    }

    for($i = 0; $i < count($favs); $i++) {
        if($favs[$i]['type'] == "bike") {
            echo '
            <a class="listClick" style="color: #4A4A4A;" id="'.$favs[$i]['sid'].'">
                <div class="listElem blue">
                    <p class="elemTitle"><i class="fas fa-bicycle"></i> '.$favs[$i]['ind'].'</p>
                    <p class="elemSub">'.$favs[$i]['distance'].' metri</p>
                    <p class="elemSub2"><i class="fas fa-heart" style="color: #F14769;"></i></p>
                </div>
            </a>
            ';
        } else {
            echo '
            <a class="listClick" style="color: #4A4A4A;" id="'.$favs[$i]['sid'].'">
                <div class="listElem">
                    <p class="elemTitle"><i class="fas fa-coffee"></i> '.$favs[$i]['ind'].'</p>
                    <p class="elemSub">'.$favs[$i]['distance'].' metri</p>
                    <p class="elemSub2"><i class="fas fa-heart" style="color: #F14769;"></i></p>
                </div>
            </a>
            ';
        }
    }
} 

$conn->close();

?>