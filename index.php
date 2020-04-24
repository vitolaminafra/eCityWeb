<?php
    session_start();
    if(isset($_SESSION["logged"])) {
        header('Location: /home.html');
    }
    if(isset($_COOKIE['logged'])) {
        header('Location: /home.html');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>eCity</title>
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

        <script defer="defer" src="js/login.js"></script>

    </head>
    <body>

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
                            if(isset($_GET["notfound"])) {
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