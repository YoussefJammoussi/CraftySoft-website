<?php
include "connect.php";


$sql = "SELECT * FROM zamovutudzvinok";
$result = $mysqli->query($sql);

$queue = array();


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $row['NUMBERdzv'] = preg_replace('/\d(?=\d{0,5}$)/', '*', $row['NUMBERdzv']);
        $queue[] = $row;
    }
}


echo json_encode($queue);

$mysqli->close();
?>