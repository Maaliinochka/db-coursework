<?php
include 'includes/db_connect.php';
include 'includes/header.php';

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='event'>";
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p><a href='event.php?id=" . $row['event_id'] . "'>Подробнее</a></p>";
    echo "</div>";
}

include 'includes/footer.php';
?>
