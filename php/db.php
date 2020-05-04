<?php
    $servername = "localhost";
    $username = "vitolam";
    $password = "";

    $conn = new mysqli($servername, $username, $password, "my_ecity");
    if(!$conn) {
        die("Not connected");
    }

    session_start();
?>