<?php
include 'includes/db_connect.php';
$pageTitle = "Детали мероприятия";
$additionalStyles = "css/event-details.css";
include 'includes/header.php';

$id = $_GET['id'];
// Информация о мероприятии
$sql = "SELECT * FROM events WHERE event_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// Информация об организаторе
$sql_org = "SELECT * FROM organizations WHERE org_id = " . $row['org_id'];
$result_org = $conn->query($sql_org);
$row_org = $result_org->fetch_assoc();

// Начало вывода страницы
?>
<div class="event-details">
    <img src="<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="event-cover">
    <div class="event-header">
        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        <div class="event-info">
            <p><strong>Дата:</strong> <?php echo date('d M Y', strtotime($row['date'])); ?></p>
            <p><strong>Время:</strong> <?php echo date('H:i', strtotime($row['time'])); ?></p>
            <p><strong>Место:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
            <p><strong>Доступность (надо подумать):</strong> <?php echo htmlspecialchars($row['accessibility']); ?></p>
        </div>
        <div class="event-buttons">
            <button class="register-button">Зарегистрироваться</button>
            <button class="favorite-button">В избранное</button>
            <button class="reviews-button">Отзывы</button>
        </div>
    </div>

    <div class="more-info">
        <div class="event-tabs">
            <button class="tab active" data-tab="description">Описание</button>
            <button class="tab" data-tab="organizer">Организатор</button>
            <button class="tab" data-tab="route">Как добраться</button>
        </div>

        <div class="tab-content" id="description">
            <h2>Описание</h2>
            <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        </div>

        <div class="tab-content" id="organizer" style="display:none;">
            <h2>Организатор</h2>
            <p><?php echo nl2br(htmlspecialchars($row_org['description'])); ?></p>
        </div>

        <div class="tab-content" id="route" style="display:none;">
            <h2>Как добраться</h2>
            <p><?php echo nl2br(htmlspecialchars($row['route'])); ?></p>
        </div>
    </div>
</div>

<script>
    // Скрипт для переключения табов
    document.querySelectorAll('.tab').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.tab').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');

            button.classList.add('active');
            document.getElementById(button.getAttribute('data-tab')).style.display = 'block';
        });
    });
</script>

<?php include 'includes/footer.php'; ?>
