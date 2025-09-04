<?php
include "connect.php";

$name = $_POST['name'];
$phone = $_POST['phone'];
$choice = $_POST['service'];

$sql = "INSERT INTO repairzayva (NAMErep, NUMBERrep, CHOICErep) VALUES ('$name', '$phone', '$choice')";

if ($mysqli->query($sql) === TRUE) {
    echo "Дані успішно вставлені";
} else {
    echo "Помилка: " . $mysqli->error;
}

$mysqli->close();
?>