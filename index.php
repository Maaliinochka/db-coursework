<?php
include 'includes/db_connect.php';
$pageTitle = "Главная страница";
$additionalStyles = "css/styles.css";
include 'includes/header.php';

// Получаем значения запроса и диапазона дат из параметров GET
$search_query = isset($_GET['query']) ? $_GET['query'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$sql = "SELECT * FROM events WHERE approved = 1";
if ($search_query) {
    $sql .= " AND title LIKE '%$search_query%'";
}
if ($start_date && $end_date) {
    $sql .= " AND date BETWEEN '$start_date' AND '$end_date'";
}
$result = $conn->query($sql);
?>

<div class="container">
    <h1>Откройте доступные мероприятия</h1>
    <p>Находите и присоединяйтесь к мероприятиям с сурдопереводом и визуальной поддержкой</p>
    
    <div class="search-bar">
        <form class="search-form" id="searchForm" method="GET" action="">
            <input type="text" placeholder="Поиск событий" id="searchInput" name="query" value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="button" id="dateButton">Дата</button>
            <button type="button">Место</button>
            <button type="button">Фильтры</button>
            <input type="hidden" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
            <input type="hidden" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
            <button type="submit">Искать</button>
        </form>
    </div>
</div>
<div class="container">
    <div class="event-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="event-card">
                <div class="event-image">
                    <img src="<?php echo $row['image']; ?>" alt="Event Image">
                </div>
                <div class="event-details">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo date('d F Y', strtotime($row['date'])); ?></p>
                    <p><?php echo $row['location']; ?></p>
                    <p><?php echo $row['accessibility']; ?></p>
                    <a href="event_details.php?id=<?php echo $row['event_id']; ?>" class="view-details">Посмотреть детали</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Подключение библиотеки flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dateButton", {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    document.getElementById('start_date').value = selectedDates[0].toISOString().split('T')[0];
                    document.getElementById('end_date').value = selectedDates[1].toISOString().split('T')[0];
                }
            }
        });
    });
</script>

<!-- Styles for the page -->
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        margin-bottom: 10px;
        text-align: center;
    }
    h1 {
        margin-bottom: 10px;
    }
    p {
        margin-top: 0;
    }
    .search-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
        gap: 10px;
    }
    .search-bar form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
        gap: 10px;
    }
    .search-form input {
        padding: 10px;
        min-width: 140%;
    }
    .search-bar button {
        padding: 10px 15px;
        background-color: #5c3bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        max-width: 100px;
    }
    .search-bar button:hover {
        background-color: #4a32cc;
    }
    .event-list {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    .event-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 20px;
        width: 300px;
        text-align: left;
    }
    .event-image img {
        width: 100%;
        border-radius: 10px;
    }
    .event-details {
        margin-top: 15px;
    }
    .event-details h3 {
        margin: 0;
        font-size: 20px;
        color: #333;
    }
    .event-details p {
        margin: 5px 0;
        color: #666;
    }
    .view-details {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #5c3bff;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
    }
    .view-details:hover {
        background-color: #4a32cc;
    }
</style>
