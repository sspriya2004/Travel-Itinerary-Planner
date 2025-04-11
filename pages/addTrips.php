<?php
session_start();
include "../db.php";

    $userId = $_SESSION['user_id'];
    $destinationId = $_POST['destination_id'];
    $tripName = $_POST['name'];
    $destination = $_POST['location'];

    $stmt = $conn->prepare("INSERT INTO trips (user_id, title, destination, start_date, end_date, duration) VALUES (?, ?, ?, NULL, NULL, NULL)");
    $stmt->bind_param("iss", $userId, $tripName, $destination);
    $stmt->execute();

    header("Location: myTrips.php");
    exit();
?>
