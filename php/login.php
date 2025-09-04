<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

$sql = "SELECT * FROM registr WHERE USERNAMEprof='$username' AND PASSWORDprof='$password'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

    session_start();
    $_SESSION['username'] = $username;

    header("Location: ../profile.php");
    exit();
} else {

    echo "Неправильний логін або пароль";
}

} else {

    echo "Неправильний метод запиту";
}

$mysqli->close();
?>