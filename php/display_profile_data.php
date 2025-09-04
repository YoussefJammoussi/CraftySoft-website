<?php
session_start();
include "connect.php";

if (!isset($_SESSION['username'])) {
    // Якщо користувач не авторизований, перенаправте його на сторінку входу
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM registr WHERE USERNAMEprof='$username'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Вибираємо дані поточного користувача
    $name = $row['NAMEprof'];
    $surname = $row['SURNAMEprof'];
    $email = $row['EMAILprof'];
    $username = $row['USERNAMEprof'];
    $birthday = $row['BIRTHDAYprof'];
    $gender = $row['GENDERprof'];
    $phone = $row['PHONEprof'];
    $subscribe = $row['SUBSCRIBEprof'];

    // **Encode profile data to JSON**
    $profileData = json_encode(array(array(
        'NAMEprof' => $name,
        'SURNAMEprof' => $surname,
        'EMAILprof' => $email,
        'USERNAMEprof' => $username,
        'BIRTHDAYprof' => $birthday,
        'GENDERprof' => $gender,
        'PHONEprof' => $phone,
        'SUBSCRIBEprof' => $subscribe,
    )));
} else {
    echo "Немає даних для відображення";
}

$mysqli->close();
?>