<?php 
    $old = md5($_POST["old"]);
    $new = md5($_POST["new"]);
    if(isset($_SESSION["logged"])) {
        $uid = $_SESSION["logged"];  
    } else {
        $uid = $_COOKIE["logged"];
    }

    $servername = "localhost";
    $username = "root";
    $password = "root";

    $conn = new mysqli($servername, $username, $password, "my_ecity");
    if(!$conn) {
        die("Not connected");
    }
    echo "Connected!";

    $sql = "SELECT * FROM utente WHERE utente.uid = $uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
        if($row["psw"] == $old) {
            $sql = "UPDATE utente SET psw = '$new' WHERE utente.uid = $uid";
            $result = $conn->query($sql);
            $conn->close();
            header('Location: /home.php?pswChanged');
        } else {
            $conn->close();
            header('Location: /home.php?pswNotEqual');
        }
    }
?>