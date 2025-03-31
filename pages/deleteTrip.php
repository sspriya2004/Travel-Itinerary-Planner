<?php
session_start();
include "../db.php";

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$trip_id = $_GET['trip_id'];

// Delete only if trip belongs to logged-in user
$sql = "DELETE FROM trips WHERE trip_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $trip_id, $user_id);

if ($stmt->execute()) {
    echo "Trip deleted successfully.";
} else {
    echo "Error deleting trip.";
}

$stmt->close();
$conn->close();

header("Location: myTrips.php");
exit();
?>
