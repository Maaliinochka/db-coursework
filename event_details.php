<?php
include 'includes/db_connect.php';
$pageTitle = "Главная страница";
$additionalStyles = "css/styles.css";
include 'includes/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE event_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo "<h1>" . $row['title'] . "</h1>";
echo "<p>" . $row['description'] . "</p>";
echo "<p>Дата: " . $row['date'] . "</p>";
echo "<p>Место: " . $row['location'] . "</p>";

include 'includes/footer.php';
?>
