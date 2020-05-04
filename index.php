<?php
    session_start();
    if(isset($_SESSION["logged"]) || isset($_COOKIE['logged'])) {
        header('Location: /home');
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>eCity</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
        <link rel="stylesheet" href="css/style.css">
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <script
            defer="defer"
            src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

        <script
            src="https://cdn.rawgit.com/mgalante/jquery.redirect/master/jquery.redirect.js"></script>

        <script defer="defer" src="js/index.js"></script>

    </head>
    <body>

        <div class="modal" id="modal">
            <div class="modal-background"></div>
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Completa la registrazione</p>
                    <button class="delete" id="close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="text" placeholder="Nome" id="nome">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="text" placeholder="Cognome" id="cognome">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-primary is-light is-outlined" id="fullsignup">Continua</button>
                </footer>
            </div>
        </div>
    <?php 
 if(isset($_GET["alreadyin"])) {
     echo '<div class="notification is-danger is-light" style="    
     width: auto;
     position: fixed;
     bottom: 0;
     right: 0;
     margin: 2em;" id="noti">
     <button class="delete" id="closenoti"></button>
     L\'utente risulta già registrato. <br>
     Effettua l\'accesso.
    </div>
    ';
 } 
 if(isset($_GET["notfound"]))  {
    echo '<div class="notification is-danger is-light" style="    
    width: auto;
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 2em;" id="noti">
    <button class="delete" id="closenoti"></button>
    L\'utente non risulta registrato. <br>
    Effettua la registrazione.
   </div>
   ';
 }

?>


        <section class="section hero is-fullheight first">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column left">
                            <h1 class="logo">eCity</h1>
                            <p class="subtitle">
                                <strong>eCity</strong>
                                raccoglie su una mappa i mezzi per bike sharing e i distributori automatici.
                                <br><br>
                                Puoi impostare un servizio come preferito, prenotarlo o visualizzare le
                                indicazioni per raggiungerlo.
                            </p>
                        </div>
                        <div class="column right">
                            <h3 class="text">Accedi o registrati!</h3>

                        <?php 
                            if(isset($_GET["notfound"]) || isset($_GET["alreadyin"])) {
                                echo '<div class="field">
                                <p class="control has-icons-left has-icons-right">
                                    <input class="input is-danger" type="email" placeholder="Email" id="email">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </p>
                                </div>
                                <div class="field">
                                <p class="control has-icons-left">
                                    <input class="input is-danger" type="password" placeholder="Password (almeno 6 caratteri)" id="password">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                                </div>';
                            } else {
                                echo '<div class="field">
                                <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="email" placeholder="Email" id="email">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control has-icons-left">
                                    <input class="input" type="password" placeholder="Password (almeno 6 caratteri)" id="password">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>';
                            }
                        ?>

                            <div class="field">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox" id="remain">
                                        Resta collegato
                                    </label>
                                </div>
                            </div>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary is-light is-outlined" id="login">Accedi</button>
                                </div>
                                <div class="control">
                                    <button class="button is-link is-light is-outlined" id="signup">Registrati</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>