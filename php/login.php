<?php
    $email = $_POST["email"];
    $psw = $_POST["password"];
    $remain = $_POST["remain"];

    $servername = "localhost";
    $username = "root";
    $password = "root";

    $conn = new mysqli($servername, $username, $password, "my_ecity");
    if(!$conn) {
        die("Not connected");
    }
    echo "Connected!";

    $sql = "SELECT * FROM utente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["email"] == $email && $row["psw"] == $psw){
                if($remain == "true") {
                    setcookie("logged", $row["uid"], time() + (86400 * 30), "/");
                } else {
                    session_start();
                    $_SESSION["logged"] = $row["uid"];
                }
                header('Location: /home.html');
            }
        }
    } 

   header('Location: /index.php?notfound');

    $conn->close();
    
?>