<?php

require ('db.php');

$lat = 41.108205;
$lng = 16.878231;

$sql = "SELECT * FROM servizio";
$result = $conn->query($sql);

$locs = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $distance = getDis($lat, $lng, $row["lat"], $row["lng"]);
        $loc = array("sid" => $row["sid"], "lat" => $row["lat"], "lng" => $row["lng"], 
            "type" => $row["tipo"], "ind" => $row["indirizzo"], "distance" => round($distance));
            array_push($locs, $loc);

    }
} 

$conn->close();

function getDis($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $distance = ($miles * 1609.344);

    return $distance;
}

function selection_sort(&$arr, $n)  
{ 
    for($i = 0; $i < $n ; $i++) 
    { 
        $low = $i; 
        for($j = $i + 1; $j < $n ; $j++) 
        { 
            if ($arr[$j]["distance"] < $arr[$low]["distance"]) 
            { 
                $low = $j; 
            } 
        } 
    
        if ($arr[$i]["distance"] > $arr[$low]["distance"]) 
        { 
            $tmp = $arr[$i]; 
            $arr[$i] = $arr[$low]; 
            $arr[$low] = $tmp; 
        } 
    } 
} 

selection_sort($locs, count($locs));

for($i = 0; $i < count($locs); $i++) {
    if($locs[$i]['type'] == "bike") {
        echo '
        <a class="listClick" style="color: #4A4A4A;" id="'.$locs[$i]['sid'].'">
            <div class="listElem blue">
                <p class="elemTitle"><i class="fas fa-bicycle"></i> '.$locs[$i]['ind'].'</p>
                <p class="elemSub">'.$locs[$i]['distance'].' metri</p>
                <p class="elemSub2"><i class="fas fa-map-marker-alt""></i></p>
            </div>
        </a>
        ';
    } else {
        echo '
        <a class="listClick" style="color: #4A4A4A;" id="'.$locs[$i]['sid'].'">
            <div class="listElem">
                <p class="elemTitle"><i class="fas fa-coffee"></i> '.$locs[$i]['ind'].'</p>
                <p class="elemSub">'.$locs[$i]['distance'].' metri</p>
                <p class="elemSub2"><i class="fas fa-map-marker-alt"></i></p>
            </div>
        </a>
        ';
    }
}
?>