<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $event_id = $_POST['event_id'];
        $sql = "DELETE FROM events WHERE event_id = $event_id";
        $conn->query($sql);
    } else {
        $event_id = $_POST['event_id'];
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $accessibility = $_POST['accessibility'];

        if ($event_id) {
            // Update existing event
            $sql = "UPDATE events SET 
                    date='$event_date', 
                    time='$event_time', 
                    location='$location', 
                    description='$description', 
                    image='$image_url', 
                    accessibility='$accessibility' 
                    WHERE event_id=$event_id";
        } else {
            // Create new event
            $sql = "INSERT INTO events (date, time, location, description, image, accessibility) 
                    VALUES ('$event_date', '$event_time', '$location', '$description', '$image_url', '$accessibility')";
        }
        $conn->query($sql);
    }
    header("Location: ../organization.php");
    exit();
}
?>
