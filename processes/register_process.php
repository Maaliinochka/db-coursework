<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_type = $_POST['user_type'];

    if ($user_type == 'user') {
        // Регистрация пользователя
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, created_at, updated_at) VALUES (?, ?, ?, 'user', ?, ?)");
        $stmt->bind_param('sssss', $fullname, $email, $password, $created_at, $updated_at);

    } elseif ($user_type == 'org') {
        // Регистрация организации
        $org_name = trim($_POST['org_name']);
        $description = trim($_POST['description']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO organizations (name, description, email, password, phone, address, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssss', $org_name, $description, $email, $password, $phone, $address, $created_at, $updated_at);
    }

    if ($stmt->execute()) {
        header("Location: pages/login.php?success=1");
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
