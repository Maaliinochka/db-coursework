<?php
$pageTitle = "Управление мероприятиями";
$additionalStyles = "css/organization.css";
include 'includes/header.php';
?>
<body>
    <div class="admin-container">
        <h2>Управление мероприятиями</h2>

        <button class="open-modal" onclick="openModal()">Добавить мероприятие</button>

        <div class="modal" id="eventModal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModal()">&times;</span>
                <h1 id="modal-title">Новое мероприятие</h1>
                <form id="eventForm" action="includes/event_handler.php" method="post">
                    <input type="hidden" id="event_id" name="event_id">
                    <div class="form-group">
                        <label for="title">Название:</label>
                        <input type="text" id="title" name="title" placeholder="Мяумяу" required>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Дата:</label>
                        <input type="date" id="event_date" name="event_date" required>
                    </div>
                    <div class="form-group">
                        <label for="event_time">Время:</label>
                        <input type="time" id="event_time" name="event_time" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Место проведения:</label>
                        <input type="text" id="location" name="location" placeholder="Event Location" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание мероприятия:</label>
                        <textarea id="description" name="description" placeholder="Event Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">URL изображения:</label>
                        <input type="url" id="image_url" name="image_url" placeholder="http://example.com/image.jpg">
                    </div>
                    <div class="form-group">
                        <label for="accessibility">надо подумать (доступность):</label>
                        <input type="text" id="accessibility" name="accessibility" placeholder="Accessibility Information" required>
                    </div>
                    <button type="submit" id="submitButton">Создать мероприятие</button>
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

<?php
include 'includes/footer.php';

