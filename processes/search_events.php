<?php
include '../includes/db_connect.php';

$search_query = isset($_GET['query']) ? $_GET['query'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$sql = "SELECT * FROM events WHERE approved = 1";
if ($search_query) {
    $sql .= " AND title LIKE '%" . $conn->real_escape_string($search_query) . "%'";
}
if ($start_date && $end_date) {
    $sql .= " AND date BETWEEN '" . $conn->real_escape_string($start_date) . "' AND '" . $conn->real_escape_string($end_date) . "'";
}

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo '<div class="event-card">
            <div class="event-image">
                <img src="' . htmlspecialchars($row['image']) . '" alt="Изображение">
            </div>
            <div class="event-details">
                <h3>' . htmlspecialchars($row['title']) . '</h3>
                <p>' . date('d F Y', strtotime($row['date'])) . '</p>
                <p>' . htmlspecialchars($row['location']) . '</p>
                <p>' . htmlspecialchars($row['accessibility']) . '</p>
                <a href="pages/event_details.php?id=' . $row['event_id'] . '" class="view-details">Посмотреть детали</a>
            </div>
          </div>';
}
?>
