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

$newEmail = filter_input(INPUT_POST, 'newEmail', FILTER_VALIDATE_EMAIL);

// Оновлення електронної пошти
try {
    $sql = "UPDATE registr SET EMAILprof = ? WHERE USERNAMEprof = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $newEmail, $authorizedUsername);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Помилка при оновленні електронної пошти']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Помилка при оновленні електронної пошти: ' . $e->getMessage()]);
}

$stmt->close();
$mysqli->close();