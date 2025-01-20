<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <script>
        function toggleForm(type) {
            document.getElementById('userForm').style.display = type === 'user' ? 'block' : 'none';
            document.getElementById('orgForm').style.display = type === 'org' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="register-container">
        <h2 style="text-align: center">Регистрация</h2>
        <div class="toggle-buttons">
            <button type="button" onclick="toggleForm('user')">Пользователь</button>
            <button type="button" onclick="toggleForm('org')">Организация</button>
        </div>

        <!-- Форма регистрации пользователя -->
        <form id="userForm" action="../processes/register_process.php" method="POST" style="display: block;">
            <input type="hidden" name="user_type" value="user">
            <label for="fullname">ФИО</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Почта</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Зарегистрироваться</button>
        </form>

        <!-- Форма регистрации организации -->
        <form id="orgForm" action="../processes/register_process.php" method="POST" style="display: none;">
            <input type="hidden" name="user_type" value="org">
            <label for="org_name">Название</label>
            <input type="text" id="org_name" name="org_name" required>

            <label for="description">Описание</label>
            <textarea id="description" name="description" required></textarea>

            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="address">Адрес</label>
            <input type="text" id="address" name="address" required>

            <label for="org_email">Почта</label>
            <input type="email" id="org_email" name="email" required>

            <label for="org_password">Пароль</label>
            <input type="password" id="org_password" name="password" required>

            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</body>
</html>
