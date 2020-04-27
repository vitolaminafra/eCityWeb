<?php
    require ('db.php');

    $lat = 41.108205;
    $lng = 16.878231;

    $sql = "SELECT * FROM servizio";
    $result = $conn->query($sql);

    $bikes = array();
    $vends = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $distance = getDis($lat, $lng, $row["lat"], $row["lng"]);
            $loc = array("sid" => $row["sid"], "lat" => $row["lat"], "lng" => $row["lng"], 
                "type" => $row["tipo"], "ind" => $row["indirizzo"], "distance" => round($distance));
            if($row["tipo"] == "bike") {
                array_push($bikes, $loc);
            } else {
                array_push($vends, $loc);
            }
                
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

    selection_sort($bikes, count($bikes));
    selection_sort($vends, count($vends));

    for($i = 0; $i < 3; $i++) {
        echo '
        <div class="column">
            <div class="serbtn">
                <a style="color: #4A4A4A;" id="'.$vends[$i]["sid"].'">
                    <p class="btntitle"><i class="fas fa-coffee"></i> - '.$vends[$i]["ind"].'</p>
                    <p class="btnsub">'.$vends[$i]["distance"].' metri</p>
                    <p class="btnsub2"><i class="fas fa-arrow-alt-circle-right"></i></p>
                </a>
            </div>
            <div class="serbtn blue">
                <a style="color: #4A4A4A;" id="'.$bikes[$i]["sid"].'">
                    <p class="btntitle"><i class="fas fa-bicycle"></i> - '.$bikes[$i]["ind"].'</p>
                    <p class="btnsub">'.$bikes[$i]["distance"].' metri</p>
                    <p class="btnsub2"><i class="fas fa-arrow-alt-circle-right"></i></p>
                </a>
            </div>
        </div>';
    }
?>