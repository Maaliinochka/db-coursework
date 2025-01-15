<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization admin Panel</title>
    <link rel="stylesheet" href="css/organization.css">
</head>
<header>
    <h1>Управление мероприятиями</h1>
    <nav>
        <a href="index.php">Главная</a>
        <a href="organization.php">Организация</a>
    </nav>
</header>
<body>
    <div class="admin-container">
        <h2>Управление мероприятиями</h2>

        <button class="open-modal" onclick="openModal()">Добавить мероприятие</button>

        <div class="modal" id="eventModal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModal()">&times;</span>
                <h1 id="modal-title">Create Event</h1>
                <form id="eventForm" action="includes/event_handler.php" method="post">
                    <input type="hidden" id="event_id" name="event_id">
                    <div class="form-group">
                        <label for="event_date">Date:</label>
                        <input type="date" id="event_date" name="event_date" required>
                    </div>
                    <div class="form-group">
                        <label for="event_time">Time:</label>
                        <input type="time" id="event_time" name="event_time" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" placeholder="Event Location" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" placeholder="Event Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL:</label>
                        <input type="url" id="image_url" name="image_url" placeholder="http://example.com/image.jpg">
                    </div>
                    <div class="form-group">
                        <label for="accessibility">Accessibility:</label>
                        <input type="text" id="accessibility" name="accessibility" placeholder="Accessibility Information" required>
                    </div>
                    <button type="submit" id="submitButton">Create Event</button>
                </form>
            </div>
        </div>

        <div class="event-list">
            <h3>Существующие мероприятия</h3>
            <?php
            // Fetch and display events from the database
            include 'includes/db_connect.php';
            $sql = "SELECT * FROM events";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="event-item">';
                echo '<p><strong>Название:</strong> ' . $row['title'] . '</p>';
                echo '<p><strong>Описание:</strong> ' . $row['description'] . '</p>';
                echo '<p><strong>Дата:</strong> ' . $row['date'] . '</p>';
                echo '<p><strong>Время:</strong> ' . $row['time'] . '</p>';
                echo '<p><strong>Место:</strong> ' . $row['location'] . '</p>';
                echo '<p><strong>Изображение:</strong> <a href="' . $row['image'] . '" target="_blank">View</a></p>';
                echo '<p><strong>Доступность:</strong> ' . $row['accessibility'] . '</p>';
                echo '<button class="edit-button" onclick="editEvent(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">Редактировать</button>';
                echo '<form action="includes/event_handler.php" method="post" style="display:inline;">
                        <input type="hidden" name="event_id" value="' . $row['event_id'] . '">
                        <button type="submit" name="delete">Удалить</button>
                      </form>';
                echo '</div>';
            }

            ?>
        </div>
    </div>

    <script src="js/organization.js"></script>
</body>
<footer>
    <p>© 2025 Инвалиды LLC</p>
</footer>
</html>