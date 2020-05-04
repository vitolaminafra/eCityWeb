<?php
    require ('db.php');

    $email = $_POST["email"];
    $psw = md5($_POST["password"]);
    $remain = $_POST["remain"];

    $sql = "SELECT * FROM utente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["email"] == $email && $row["psw"] == $psw){
                if($remain == "true") {
                    setcookie("logged", $row["uid"], time() + (86400 * 30), "/");
                } else {
                    $_SESSION["logged"] = $row["uid"];
                }
                header('Location: /home');
            }
        }
    } 
    $conn->close();
    header('Location: /index?notfound');
?>