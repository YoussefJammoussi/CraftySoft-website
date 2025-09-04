<?php
session_start();

include 'connect.php';

// Перевірка, чи користувач авторизований
if (isset($_SESSION['username'])) {
    $authorizedUsername = $_SESSION['username'];
} else {
    echo json_encode(['error' => 'Користувач не авторизований']);
    exit;
}

$newPhone = filter_input(INPUT_POST, 'newPhone', FILTER_SANITIZE_STRING);

// Оновлення номера телефону
try {
    $sql = "UPDATE registr SET PHONEprof = ? WHERE USERNAMEprof = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $newPhone, $authorizedUsername);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Помилка при оновленні номера телефону']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Помилка при оновленні номера телефону: ' . $e->getMessage()]);
}

$stmt->close();
$mysqli->close();