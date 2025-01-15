<?php
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $accessibility = $_POST['accessibility'];

    $sql = "INSERT INTO events (event_date, event_time, location, description, image_url, accessibility)
            VALUES ('$event_date', '$event_time', '$location', '$description', '$image_url', '$accessibility')";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>
