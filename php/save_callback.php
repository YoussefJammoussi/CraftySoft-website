<?php
include "connect.php";

$name = $_POST['name'];
$phone = $_POST['phone'];



$sql = "INSERT INTO zamovutudzvinok (NAMEdzv, NUMBERdzv) VALUES ('$name', '$phone')";

if ($mysqli->query($sql) === TRUE) {
    echo "Дані успішно вставлені";
} else {
    echo "Помилка: " . $mysqli->error;
}

$mysqli->close();
?>