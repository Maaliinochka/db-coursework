<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Мероприятия"; ?></title>
    <!-- Шрифт -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Стили -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <?php if (isset($additionalStyles)) : ?>
        <link rel="stylesheet" href="<?php echo $additionalStyles; ?>">
    <?php endif; ?>
</head>
<body>
<header>
    <h1>МероприятияДляВсех</h1>
    <nav>
        <a href="../index.php">Главная</a>
        <?php
            session_start();
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                if ($_SESSION['role'] == 'org') {
                    echo '<a href="../pages/organization.php">Профиль</a>';
                } else {
                    echo '<a href="../pages/profile.php">Профиль</a>';
                }
                echo '<a href="../processes/logout.php">Выйти</a>';
            } else {
                echo '<a href="../pages/login.php">Войти</a>';
            }
        ?>
    </nav>
</header>
<main>
