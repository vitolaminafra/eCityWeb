<?php
    require_once ($DOCUMENT_ROOT . 'php/db.php');

    session_start();
    if(!isset($_SESSION["logged"]) && !isset($_COOKIE['logged'])) {
        header('Location: /');
    }

    if(isset($_SESSION["logged"])) {
        $sql = "SELECT * FROM utente WHERE uid = ".$_SESSION["logged"];  
      } else {
          $sql = "SELECT * FROM utente WHERE uid = ".$_COOKIE["logged"];
      }

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc(); 
          $nome = $row["nome"];
          $cognome = $row["cognome"];
          $email = $row["email"];
      }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>eCity - Home</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
        <!-- MY CSS -->
        <link rel="stylesheet" href="css/style_home.css">

        <!-- BULMA CSS AND JS -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <script
            defer="defer"
            src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

        <!-- JQUERY -->
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

        <!-- MAPBOX CSS AND JS FOR MAP -->
        <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
        <link
            href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css'
            rel='stylesheet'/>
        <script
            src="https://cdn.rawgit.com/mgalante/jquery.redirect/master/jquery.redirect.js"></script>
        <!-- MY JS -->
        <script src="js/home.js"></script>

    </head>
    <body>
      <?php
        if(isset($_GET["pswChanged"])) {
            echo '<div class="notification is-success is-light" style="    
            width: auto;
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 1000;
            margin: 2em;" id="noti">
            <button class="delete" id="closenoti"></button>
            Password modificata con successo!
        </div>
        ';
        } 

        if(isset($_GET["pswNotEqual"])) {
            echo '<div class="notification is-danger is-light" style="    
            width: auto;
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 1000;
            margin: 2em;" id="noti">
            <button class="delete" id="closenoti"></button>
            La password attuale non è corretta. <br>
            La password non è stata cambiata!
        </div>
        ';
        } 

        if(isset($_GET["dataChanged"])) {
            echo '<div class="notification is-success is-light" style="    
            width: auto;
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 1000;
            margin: 2em;" id="noti">
            <button class="delete" id="closenoti"></button>
            I dati sono stati modificati con successo!
        </div>
        ';
        } 
?>

    <div class="modal" id="changeDataModal">
            <div class="modal-background"></div>
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Modifica dati</p>
                    <button class="delete" id="closeData" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <?php echo '<input class="input" type="text" placeholder="Nome" id="nome" value="'.$nome.'">'; ?>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                        <?php echo '<input class="input" type="text" placeholder="Cognome" id="cognome" value="'.$cognome.'">'; ?>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-primary is-light is-outlined" id="changeData">Conferma</button>
                    <button class="button" id="closeDataBtn">Annulla</button>
                </footer>
            </div>
        </div>

        <div class="modal" id="changePswModal">
            <div class="modal-background"></div>
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Modifica password</p>
                    <button class="delete" id="closePsw" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Password attuale" id="oldPsw">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Nuova (almeno 6 caratteri)" id="newPsw">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-primary is-light is-outlined" id="changePsw">Conferma</button>
                    <button class="button" id="closePswBtn">Annulla</button>
                </footer>
            </div>
        </div>

        <div class="modal" id="logoutModal">
            <div class="modal-background"></div>
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Esci</p>
                    <button class="delete" id="closeLogout" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    Vuoi davvero uscire?
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-danger is-light is-outlined" id="logout">Esci</button>
                    <button class="button" id="closeLogoutBtn">Annulla</button>
                </footer>
            </div>
        </div>


        <div class="modal" id="serModal">
            <div class="modal-background"></div>
            <div class="modal-card" style="width: 25.5em;">
                <header class="modal-card-head">
                    <p class="modal-card-title"><i class="fas fa-coffee"></i> - Via E. Orabona 4</p>
                    <button class="delete" id="closeLogout" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    Tipo qua si vede la mappa!
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-danger is-light is-outlined" id="logout">
                        <span class="icon is-small">
                            <i class="fas fa-heart"></i>
                        </span>
                        <span>Preferito</span>
                    </button>
                    <button class="button is-info is-light is-outlined" id="logout">
                        <span class="icon is-small">
                            <i class="fas fa-bookmark"></i>
                        </span>
                        <span>Prenota</span>
                    </button>
                    <button class="button is-primary is-light is-outlined" id="logout">
                        <span class="icon is-small">
                            <i class="fas fa-map-signs"></i>
                        </span>
                        <span>Indicazioni</span>
                    </button>
                </footer>
            </div>
        </div>

        <nav class="navbar" role="navigation" aria-label="dropdown navigation">
        <style scoped>
            @media only screen and (max-width: 1024px) {
                a.navbar-burger {
                    display: inline;
                    position: absolute;
                    right: 0;
                    margin-top: .5em;
                }
            }
        </style>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>

            <div class="navbar-brand">
                <a class="navbar-item" href="#">
                    <h1 class="logo">eCity</h1>
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Ciao, <?php echo $nome; ?>! 
                        </a>
                        <div class="navbar-dropdown is-right">
                            <a class="navbar-item" id="changeDataBtn">
                                Modifica dati
                            </a>
                            <a class="navbar-item" id="changePswBtn">
                                Modifica password
                            </a>
                            <hr class="navbar-divider">
                                <a class="navbar-item" id="logoutBtn">
                                    Esci
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    <div class="container">
        <div class="columns">
            <div class="column mapcol">
                <div id='map'></div>
                <script>
                    mapboxgl.accessToken = 'pk.eyJ1Ijoidml0b2xhbSIsImEiOiJjajYwcGk1cnEwbHBtMzJueWV6YmM2N2M1In0.Aq6CkjudAJH' +
                            'X1PymrhEb6Q';
                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/light-v9',
                        center: [
                            16.878231, 41.108205
                        ],
                        zoom: 15
                    });

                    map.addControl(new mapboxgl.NavigationControl());

                    var currentPos = new mapboxgl
                        .Marker({draggable: false})
                        .setLngLat([16.878231, 41.108205])
                        .addTo(map);

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    }

                    function showPosition(position) {
                        currentPos.setLngLat([position.coords.longitude, position.coords.latitude]);
                    }

                    currentPos.getElement().childNodes[0].childNodes[0].childNodes[1].setAttribute("fill", "#F14769");

                    for(var i = 2; i < 23; i++) {
                        $.ajax({
                        url: "/php/getLocations.php?sid="+i,
                        type: 'get',
                        dataType: 'JSON',
                            success: function(response) {
                                var sid = response["sid"];
                                var lat = response["lat"];
                                var lng = response["lng"];
                                var type = response["type"];
                                
                                var marker = new mapboxgl
                                    .Marker({draggable: false})
                                    .setLngLat([lng, lat])
                                    .addTo(map);

                                marker.getElement().id = sid;
                                marker.getElement().classList.add("marker");
                                
                                if(type == "bike") {
                                    marker.getElement().childNodes[0].childNodes[0].childNodes[1].setAttribute("fill", "#01A0FB");
                                } else {
                                    marker.getElement().childNodes[0].childNodes[0].childNodes[1].setAttribute("fill", "#29F29B");
                                }   
                                //console.log(marker.getElement());
                            }    
                        });
                    }

                </script>
            </div>
            <div class="column right">
                <h1 class="sectitle">Nelle vicinanze</h1>
                <div class="columns">
                    <?php 
                        require ($DOCUMENT_ROOT . 'php/printNearButtons.php');
                        
                    ?>
                </div>
                <h1 class="sectitle">Preferiti <i class="fas fa-sm fa-chevron-down"></i></h1>
                <div class="columns">
                    <?php 
                        require ($DOCUMENT_ROOT . 'php/printFavButtons.php');
                    ?>
                </div>

                <h1 class="sectitle">Prenotati <i class="fas fa-sm fa-chevron-down"></i></h1>
                <div class="columns">
                    <div class="column">
                        <div class="serbtn blue">
                            <p class="btntitle"><i class="fas fa-coffee"></i> - Via E. Orabona 4</p>
                            <p class="btnsub">500 metri - Scade fra <strong>25</strong> minuti</p>
                            <p class="btnsub2"><i class="fas fa-clock"  style="color: #3398DC;"></i></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>