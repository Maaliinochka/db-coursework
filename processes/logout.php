<?php
session_start();

// Удаление всех данных сессии
session_unset();  // Очистка всех переменных сессии
session_destroy();  // Уничтожение сессии

// Перенаправление пользователя на страницу входа или главную страницу
header("Location: ../pages/login.php");
exit();
?>
