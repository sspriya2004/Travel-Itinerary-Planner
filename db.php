<?php 
$servername = "localhost";
$username = "root";
$password = "1544";
$dbname = "travel_itinerary_planner";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully!!! ";
?>