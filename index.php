<?php
include 'includes/db_connect.php';
$pageTitle = "Главная страница";
$additionalStyles = "css/index.css";
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
        <div class="event-list" id="eventList">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="event-card">
                    <div class="event-image">
                        <img src="<?php echo $row['image']; ?>" alt="Изображение">
                    </div>
                    <div class="event-details">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo date('d F Y', strtotime($row['date'])); ?></p>
                        <p><?php echo $row['location']; ?></p>
                        <p><?php echo $row['accessibility']; ?></p>
                        <a href="pages/event_details.php?id=<?php echo $row['event_id']; ?>" class="view-details">Посмотреть детали</a>
                    </div>
                </div>
            <?php } ?>
        </div>
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
    document.getElementById('searchInput').addEventListener('input', function() {
        let query = this.value;
        let startDate = document.getElementById('start_date').value;
        let endDate = document.getElementById('end_date').value;

        fetch(`processes/search_events.php?query=${query}&start_date=${startDate}&end_date=${endDate}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('eventList').innerHTML = data;
            })
            .catch(error => console.error('Error fetching events:', error));
    });

</script>