<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    // Поиск пользователя по email
    $stmt = $conn->prepare("SELECT user_id, username, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $username, $email, $hashed_password, $role);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            // Успешный вход
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['loggedin'] = true;
            header("Location: ../index.php");
        } else {
            // Неверный пароль
            header("Location: ../pages/login.php?error=Неверный пароль");
        }
    } else {
        // Поиск организации по email
        $stmt = $conn->prepare("SELECT org_id, name, email, password FROM organizations WHERE email = ?");
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($org_id, $name, $email, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Успешный вход
                $_SESSION['user_id'] = $org_id;
                $_SESSION['username'] = $name;
                $_SESSION['role'] = 'org';
                $_SESSION['org_id'] = $org_id;
                $_SESSION['loggedin'] = true;
                header("Location: ../index.php");
            } else {
                // Неверный пароль
                header("Location: ../pages/login.php?error=Неверный пароль");
            }
        } else {
            // Пользователь или организация не найдены
            header("Location: ../pages/login.php?error=Пользователь или организация не найдены");
        }
    }
    $stmt->close();
}
$conn->close();
?>
