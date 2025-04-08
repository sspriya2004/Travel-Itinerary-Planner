<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to create a trip.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID
$username = $_SESSION['username'];
if (isset($_POST['form_submit'])) {
    $title = $_POST['title'];
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $duration = $start->diff($end)->days;

    $travellers = $_POST['travellers'];

    $sql = "INSERT INTO trips (user_id, title, destination, start_date, end_date, duration, no_of_travellers) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssii", $user_id, $title, $destination, $start_date, $end_date, $duration, $travellers);

    if ($stmt->execute()) {
        header("Location: tripCreated.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create trips</title>
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
    <div class="sidenav" id="sidenav">
        <div class="menu-toggle" id="menu-toggle">
            <span>☰</span>
        </div>
        <h3 class="text-white text-center span-text">Travel Itinerary Planner</h3>
        <div class="container nav-container">
            
            <div class="menu-container ">
                <div class="icon-text ">
                    <div class="i-container">
                        <span class="material-symbols-outlined">
                            flight
                        </span>
                    </div>
                    <li class="menu-text">   
                        <a href="myTrips.php" class="menu-link">My Trips</a>
                    </li>    
                </div>
            </div>
            <!-- #2_menu -->
            <div class="menu-container  menu-active">
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
    <?php echo '<center style="margin-top:36px;"><span style="color: #4B70F5; font-weight: 600; font-size: 25px;">Logged in as ' . $username . '</span></center>'; ?>
        <div class="container py-5 mt-0">
            <form method="post" action="createTrips.php" class=" rounded shadow form p-5" id="form-validate">
                <h2 class="text-center mb-5 text-grad">Create your trip and Start your journey</h2>
                <div class="row d-flex">
                    <div class="col mb-5">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-fields" id="title" name="title" placeholder="Add a title for your trip" required>
                    </div>
                </div>

                <div class="row d-flex">
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label">Number of Travellers</label>
                        <input type="number" class="form-fields" id="travellers" name="travellers" placeholder="Number of travellers" required>
                    </div>
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-fields" placeholder="Destination" id="destination" name="destination" required> 
                    </div>
                </div>
                
                <div class="row d-flex">
                    <div class="mb-5 col-sm-4 justify-content-between">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-fields" id="start_date" name="start_date" required> 
                    </div>

                    <div class="mb-5 col-sm-4 justify-content-between">
                    <label class="form-label">End Date</label>
                        <input type="date" class="form-fields" id="end_date" name="end_date" required> 
                    </div>

                    <div class="mb-5 col-sm-4 justify-content-between">
                        <label class="form-label">Duration</label>
                        <input type="number" class="form-fields" placeholder="Read automatically in days" id="duration" name="duration" readonly required> 
                    </div>
                </div>
                
                <div class="container d-flex btn-container mt-3">
                    <button type="submit" class="btn-grad mb-5 form-submit" id="formSubmit" name="form_submit">Submit</button>    
                </div>
            </form>
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