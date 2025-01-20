<?php
// session_start();
include '../includes/db_connect.php';

$pageTitle = "Профиль пользователя";
$additionalStyles = "../css/profile.css";
include '../includes/header.php';

// Запрос для избранных мероприятий
$user_id = $_SESSION['user_id'];
$sql_favourites = "SELECT * FROM events AS e INNER JOIN favorites AS f ON e.event_id = f.event_id WHERE e.approved = 1 AND f.user_id = $user_id";
$result_favourites = $conn->query($sql_favourites);
?>

<div class="container">
    <h1>Профиль пользователя</h1>
    <div class="tabs">
        <button class="tab-button active" onclick="showTab('favourites')">Избранное</button>
        <button class="tab-button" onclick="showTab('notifications')">Уведомления</button>
    </div>

    <div id="favourites" class="tab-content active">
        <?php while ($row = $result_favourites->fetch_assoc()) { ?>
            <div class="event-card">
                <div class="event-image">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Изображение">
                </div>
                <div class="event-details">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo date('d F Y', strtotime($row['date'])); ?></p>
                    <p><?php echo htmlspecialchars($row['location']); ?></p>
                    <p><?php echo htmlspecialchars($row['accessibility']); ?></p>
                    <a href="event_details.php?id=<?php echo $row['event_id']; ?>" class="view-details">Посмотреть детали</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="notifications" class="tab-content">
        <p>Здесь будут отображаться ваши уведомления.</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));
    document.getElementById(tabName).classList.add('active');
    document.querySelector(`.tab-button[onclick="showTab('${tabName}')"]`).classList.add('active');
}
</script>
