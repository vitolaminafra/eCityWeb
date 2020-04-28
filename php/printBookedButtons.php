<?php
    require ('db.php');

    if(isset($_SESSION["logged"])) {
        $sql = "SELECT *, UNIX_TIMESTAMP(prenotazione.ts) + 1800 AS scad FROM prenotazione WHERE uid = ".$_SESSION["logged"]." ORDER BY UNIX_TIMESTAMP(prenotazione.ts) DESC";  
      } else {
        $sql = "SELECT *, UNIX_TIMESTAMP(prenotazione.ts) + 1800 AS scad FROM prenotazione WHERE uid = ".$_COOKIE["logged"]." ORDER BY UNIX_TIMESTAMP(prenotazione.ts) DESC";
      }
    

    $result = $conn->query($sql);
    $booked = array();
    
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
                "type" => $serRow["tipo"], "ind" => $serRow["indirizzo"], "distance" => round($distance), 
                "attivo" => $row['attivo'], "scad" => $row["scad"], "pid"=> $row["pid"]);
            array_push($booked, $loc);
        }
    }

    $conn->close();
    
        if(count($booked) > 3) {
            $n = 3;
        } else {
            $n = count($booked);
        }
    
      for($i = 0; $i < $n; $i++) {
          $now = new DateTime();
          $time = round(($booked[$i]["scad"] - $now->getTimestamp()) / 60);
          if($time == 0) $time = 1;


        if($booked[$i]["attivo"] == "true") {
            echo '
            <div class="column">
                <div class="serbtn blue">
                    <a style="color: #4A4A4A;" id="'.$booked[$i]["sid"].'" pid="'.$booked[$i]["pid"].'" class="btn">
                        <p class="btntitle"><i class="fas fa-bicycle"></i> '.$booked[$i]["ind"].'</p>
                        <p class="btnsub">'.$booked[$i]["distance"].' metri - Scade tra <strong>'.$time.'</strong> minuti</p>
                        <p class="btnsub2"><i class="fas fa-clock" style="color: #3398DC;"></i></p>
                    </a>
                </div>
            </div>';
        } else {
            echo '
            <div class="column">
                <div class="serbtn blue">
                    <a style="color: #4A4A4A;" id="'.$booked[$i]["sid"].'" pid="'.$booked[$i]["pid"].'" class="btn">
                        <p class="btntitle"><i class="fas fa-bicycle"></i> '.$booked[$i]["ind"].'</p>
                        <p class="btnsub">'.$booked[$i]["distance"].' metri - <strong>Scaduto</strong></p>
                        <p class="btnsub2"><i class="fas fa-clock" style="color: #3398DC;"></i></p>
                    </a>
                </div>
            </div>';
        }
    } 
    if($n == 2) {
        echo '<div class="column"></div>';
    }





?> 