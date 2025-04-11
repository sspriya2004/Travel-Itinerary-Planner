<?php
session_start();
include "../db.php"; // Include your database connection file

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your trips.";
    header("Location: login.php");
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID
$username = $_SESSION['username']; 

// Fetch trips for the logged-in user
$sql = "SELECT trip_id, title, destination, start_date, end_date, duration, no_of_travellers FROM trips WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<?php

include '../db.php'; // your DB connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; // Assuming user is logged in
    $destinationId = $_POST['destination_id'];
    $tripName = $_POST['name'];
    $destination = $_POST['location'];

    $stmt = $conn->prepare("INSERT INTO trips (user_id, title, destination, start_date, end_date, duration) VALUES (?, ?, ?, NULL, NULL, NULL)");
    $stmt->bind_param("iss", $userId, $tripName, $destination);
    $stmt->execute();

    // echo "Trip added successfully!";
    header("Refresh:0; url=myTrips.php");

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My trips</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/forms.css">
    <link rel="stylesheet" href="../assets/css/myTrips.css">
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />
    <!-- logo -->
    <link rel="icon" href="../Assets/logo-removebg-preview (1).png" type="image/x-icon">
    <style>
        table, th, td {
            border: 3px solid white;
            padding:20px;
        }
        #table{
            /* margin-left: 39px; */
            border: 1px solid gray;
        }
        th{
            background-image: linear-gradient(319deg, #fce055 0%, #4B70F5 51%, #03AED2 100%);
            background-size: 150% 220%;
            color: white;
        }
        td{
            border: 1px solid #D3D3D3 ;
        }
        form{
            width: 100%;
        }
    </style>
</head>
<body class="wrapper">
    <div class="sidenav" id="sidenav">
        <div class="menu-toggle" id="menu-toggle">
            <span>☰</span>
        </div>
        <h3 class="text-white text-center span-text">Travel Itinerary Planner</h3>
        <div class="container nav-container">

            <!-- #1_menu -->
            <div class="menu-container menu-active">
                <div class="icon-text ">
                    <div class="i-container">
                        <span class="material-symbols-outlined">
                            flight
                        </span>
                    </div>
                    <li class="menu-text">   
                        <a href="#" class="menu-link">My Trips</a>
                    </li>    
                </div>
            </div>
            <!-- #2_menu -->
            <div class="menu-container">
                <div class="icon-text ">
                    <div class="i-container">
                        <span class="material-symbols-outlined">
                            add_circle
                        </span>
                    </div>
                    <li class="menu-text">   
                        <a href="createTrips.php" class="menu-link">Create Trips</a>
                    </li>    
                </div>
            </div>
            <!-- #3_menu -->
            <div class="menu-container">
                <div class="icon-text ">
                    <div class="i-container">
                        <span class="material-symbols-outlined">
                            travel_explore
                        </span>
                    </div>
                    <li class="menu-text">   
                        <a href="exploreDestination.php" class="menu-link">Explore Destination</a>
                    </li>    
                </div>
            </div>
            
            <!-- #1_menu -->
            <div class="menu-container">
                <div class="icon-text">
                    <div class="i-container py-1">
                        <span class="material-symbols-outlined">
                            confirmation_number
                        </span>
                    </div>
                    <li class="menu-text">   
                        <a href="bookings.php" class="menu-link">Bookings</a>
                    </li>    
                </div>
            </div>
            <!-- #2_menu -->
            <div class="menu-container">
                <div class="icon-text">
                    <div class="i-container py-1">
                        <span class="material-symbols-outlined">
                            currency_rupee_circle
                        </span>
                    </div>
                    <li class="menu-text">   
                        <a href="budgetExpenses.php" class="menu-link">Budget and Expense</a>
                    </li>    
                </div>
            </div>
            <!-- logout -->
            <div class="icon-text mt-3 logout-div">
                <div class="i-container py-1">
                    <i class='bx bx-log-out-circle bx-icon'></i>
                </div>
                <a href="logout.php">
                    <button class="menu-text text-white btn-logout" id="btn-logout" name="logout">Logout</button>
                </a>
            </div>
        </div>
    </div>
    <section class="main-content" id="main-content">
        <div class="account" style="padding:30px; display: flex; float:right">
            <span class="material-symbols-outlined" style="color: gray; float: left; position: relative; top: 3px;">
                account_circle
            </span>
            <?php echo '<center"><span style="color: gray; font-size: 18px; float:right;">' . $username . '</span></center>'; ?>

        </div>
    <div class="container py-5 mt-5">

        <table id="table">
        <tr>
            <th>Title</th>
            <th>Destination</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration (Days)</th>
            <th>Travelers</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['destination']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['end_date']}</td>
                        <td>{$row['duration']}</td>
                        <td>{$row['no_of_travellers']}</td>
                        <td>
                            <a href='editTrip.php?trip_id={$row['trip_id']}' class='btn-delete btn btn-primary' style='width: 100px;'>Edit</a> &nbsp
                            <a href='deleteTrip.php?trip_id={$row['trip_id']}' class='btn-delete btn btn-danger' style='width: 100px;'>Delete</a> &nbsp 
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No trips found.</td></tr>";
        }
        ?>
    </table>

        </div>
    </section>
    <script src="../assets/js/main.js"></script>
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>