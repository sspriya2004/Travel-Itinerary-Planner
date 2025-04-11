<?php
session_start();
include "../db.php";

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}
$user_id = $_SESSION['user_id'];
if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];  // Before form submission
} elseif (isset($_POST['trip_id'])) {
    $trip_id = $_POST['trip_id']; // After form submission
} else {
    die("Error: Trip ID is missing.");
}
echo $trip_id;
// Fetch existing trip details
$sql = "SELECT * FROM trips WHERE trip_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $trip_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$trip = $result->fetch_assoc();

// Handle form submission
if (isset($_POST['update'])) {
    $title = $_POST['new_title'];
    $destination = $_POST['new_destination'];
    $start_date = $_POST['new_start_date'];
    $end_date = $_POST['new_end_date'];
    $travellers = $_POST['new_travellers'];

    // Calculate duration
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $duration = $start->diff($end)->days;

    // Update trip
    $update_sql = "UPDATE trips SET title=?, destination=?, start_date=?, end_date=?, duration=?, no_of_travellers=? WHERE trip_id=? AND user_id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssiiii", $title, $destination, $start_date, $end_date, $duration, $travellers, $trip_id, $user_id);
    
    if ($update_stmt->execute()) {
        echo "updated";
        header("Location: myTrips.php");
    } else {
        echo "Error updating trip.";
    }

    $update_stmt->close();
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Fees Entry Form</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/forms.css">
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />
    <!-- logo -->
    <link rel="icon" href="../Assets/logo-removebg-preview (1).png" type="image/x-icon">
</head>
<body class="wrapper">
   
    <!-- <section class="main-content" id="main-content"> -->
        <div class="container py-5 mt-0">
        <form method="post" action="editTrip.php" class="rounded shadow form p-5" id="form-validate">
                <h2 class="text-center mb-5 text-grad">Create your trip and Start your journey</h2>
                <div class="row d-flex">
                    <div class="col mb-5">
                        <label class="form-label">Title</label>
                        <input type="hidden" name="trip_id" value="<?php echo $trip_id; ?>">
                        <input type="text" class="form-fields" id="title" value="<?php echo $trip['title']; ?>" name="new_title" placeholder="Add a title for your trip" required>
                    </div>
                </div>

                <div class="row d-flex">
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label">Number of Travellers</label>
                        <input type="number" class="form-fields" id="travellers" value="<?php echo $trip['no_of_travellers']; ?>"  name="new_travellers" placeholder="Number of travellers" required>
                    </div>
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-fields" value="<?php echo $trip['destination']; ?>" placeholder="Destination" id="destination" name="new_destination" required> 
                    </div>
                </div>
                
                <div class="row d-flex">
                    <div class="mb-5 col-sm-6 justify-content-between">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-fields" id="start_date" value="<?php echo $trip['start_date']; ?>" name="new_start_date" required> 
                    </div>

                    <div class="mb-5 col-sm-6 justify-content-between">
                    <label class="form-label">End Date</label>
                        <input type="date" class="form-fields" id="end_date" value="<?php echo $trip['end_date']; ?>" name="new_end_date" required> 
                    </div>
                </div>
                
                <div class="container d-flex btn-container mt-3">
                    <button type="submit" class="btn-grad mb-5 form-submit" id="formSubmit" name="update">Update Trip</button>    
                </div>
            </form>
        </div>
    <!-- </section> -->
    <script src="../assets/js/main.js"></script>
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>