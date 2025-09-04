<?php
include "connect.php";

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phoneNumber = $_POST['phoneNumber'];
$subscribe = ($_POST['subscribe']);

$sql = "INSERT INTO registr (NAMEprof, SURNAMEprof, EMAILprof, USERNAMEprof, PASSWORDprof, BIRTHDAYprof, GENDERprof, PHONEprof, SUBSCRIBEprof) 
        VALUES ('$name', '$surname', '$email', '$username', '$password', '$dob', '$gender', '$phoneNumber', '$subscribe')";

if ($mysqli->query($sql) === TRUE) {
    echo "Реєстрація пройшла успішно!";
} else {
    echo "Помилка: " . $mysqli->error;
}

$mysqli->close();
?>