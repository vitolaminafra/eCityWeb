<?php 
    require ('db.php');

    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];

    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }

    $sql = "UPDATE utente SET nome = '$nome', cognome = '$cognome' WHERE utente.uid = $uid";
    $result = $conn->query($sql);

    $conn->close();
    header('Location: /home.php?dataChanged');

?>