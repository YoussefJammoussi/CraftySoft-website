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

$newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);

// Оновлення пароля
try {
    $sql = "UPDATE registr SET PASSWORDprof = ? WHERE USERNAMEprof = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $newPassword, $authorizedUsername);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Помилка при оновленні пароля']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Помилка при оновленні пароля: ' . $e->getMessage()]);
}

$stmt->close();
$mysqli->close();
?>