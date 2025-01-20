<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];

    // Проверка на ошибки в переданных данных
    if (!$user_id || !$event_id) {
        echo "Ошибка: некорректные данные пользователя или мероприятия.";
        exit;
    }

    // Проверка, что мероприятие еще не добавлено в избранное
    $check_sql = "SELECT * FROM favorites WHERE user_id = ? AND event_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Добавление в избранное
        $insert_sql = "INSERT INTO favorites (user_id, event_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            echo "Ошибка подготовки запроса: " . $conn->error;
            exit;
        }
        $stmt->bind_param("ii", $user_id, $event_id);
        if ($stmt->execute()) {
            echo "Мероприятие успешно добавлено в избранное.";
        } else {
            echo "Ошибка при добавлении в избранное: " . $stmt->error;
        }
    } else {
        echo "Мероприятие уже добавлено в избранное.";
    }

    $stmt->close();
    $conn->close();
}
?>
