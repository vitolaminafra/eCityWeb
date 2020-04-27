<?php
require ('db.php');

if(isset($_SESSION["logged"])) {
    $sql = "SELECT * FROM preferito WHERE uid = ".$_SESSION["logged"];  
  } else {
    $sql = "SELECT * FROM preferito WHERE uid = ".$_COOKIE["logged"];
  }

$result = $conn->query($sql);
$favs = array();

$lat = 41.108205;
$lng = 16.878231;

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
}  

$conn->close();

  for($i = 0; $i < count($favs); $i++) {
    if($favs[$i]["type"] == "vend") {
        echo '
        <div class="column">
            <div class="serbtn">
                <a style="color: #4A4A4A;" id="'.$favs[$i]["sid"].'" class="btn">
                    <p class="btntitle"><i class="fas fa-coffee"></i> - '.$favs[$i]["ind"].'</p>
                    <p class="btnsub">'.$favs[$i]["distance"].' metri</p>
                    <p class="btnsub2"><i class="fas fa-heart" style="color: #F14769;"></i></p>
                </a>
            </div>
        </div>';
    } else {
        echo '
        <div class="column">
            <div class="serbtn blue">
                <a style="color: #4A4A4A;" id="'.$favs[$i]["sid"].'" class="btn">
                    <p class="btntitle"><i class="fas fa-bicycle"></i> - '.$favs[$i]["ind"].'</p>
                    <p class="btnsub">'.$favs[$i]["distance"].' metri</p>
                    <p class="btnsub2"><i class="fas fa-heart" style="color: #F14769;"></i></p>
                </a>
            </div>
        </div>';
    }
}  
    
?>