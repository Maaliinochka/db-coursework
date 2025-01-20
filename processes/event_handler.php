<?php
include '../includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $event_id = $_POST['event_id'];
        $sql = "DELETE FROM
                    events
                WHERE
                    event_id = $event_id AND
                    org_id = $org_id";
        $conn->query($sql);
    } else {
        $org_id = $_SESSION['org_id'];
        $event_id = $_POST['event_id'];
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $accessibility = $_POST['accessibility'];
        $title = $_POST['title'];

        if ($event_id) {
            $sql = "UPDATE
                        events
                    SET 
                        title='$title',
                        date='$event_date', 
                        time='$event_time', 
                        location='$location', 
                        description='$description', 
                        image='$image_url', 
                        accessibility='$accessibility',
                        approved=0
                    WHERE
                        event_id = $event_id AND
                        org_id = $org_id";
        } else {
            $sql = "INSERT INTO events (
                        title,
                        date,
                        time,
                        location,
                        description,
                        image,
                        accessibility,
                        org_id
                    ) 
                    VALUES (
                        '$title',
                        '$event_date',
                        '$event_time',
                        '$location',
                        '$description',
                        '$image_url',
                        '$accessibility',
                        '$org_id'
                    )";
        }
        $conn->query($sql);
    }
    header("Location: ../pages/organization.php");
    exit();
}
?>
