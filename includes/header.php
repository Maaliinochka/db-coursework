<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Мероприятия"; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <?php if (isset($additionalStyles)) : ?>
        <link rel="stylesheet" href="<?php echo $additionalStyles; ?>">
    <?php endif; ?>
</head>
<body>
<header>
    <h1>Все мероприятия</h1>
    <nav>
        <a href="index.php">Главная</a>
        <a href="organization.php">Организация</a>
    </nav>
</header>
<main>
