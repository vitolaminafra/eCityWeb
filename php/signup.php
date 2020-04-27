<?php
    require ('db.php');
    
    $email = $_POST["email"];
    $psw = $_POST["password"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $remain = $_POST["remain"];

    $sql = "SELECT * FROM utente WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header('Location: /index.php?alreadyin');
    } else {
        $sql = "INSERT INTO utente(nome, cognome, email, psw) VALUES ('$nome', '$cognome', '$email', '".md5($psw)."')";
        $result = $conn->query($sql);

        $sql = "SELECT * FROM utente WHERE email = '$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
            if($remain == "true") {
                setcookie("logged", $row["uid"], time() + (86400 * 30), "/");
            } else {
                session_start();
                $_SESSION["logged"] = $row["uid"];
            }
            $conn->close();
            header('Location: /home.php');
        } 
    }

?>