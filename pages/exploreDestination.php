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


if (isset($_POST['submit'])) {
    // echo "<script>
    //         document.getElementById('form-validate').style = display:none;
    //     </script>";

    // $budget = $_POST['budget'];
    // $season = $_POST['season'];
    // $traveler = $_POST['traveler'];
    // $category = $_POST['category'];
    
    // $_SESSION['budget'] = $row['budget'];  // Store user_id in session
    // $_SESSION['season'] = $row['best_season'];
    // $_SESSION['traveler'] = $row['recommended_for'];  // Store user_id in session
    // $_SESSION['category'] = $row['category'];
    // $_SESSION['username'] = $username;
    
    header('Location: filter.php');

    $stmt->close();
    $conn->close();
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
            <div class="menu-container  menu-active">
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
        <div class="container py-5 mt-3">
            
            <form method="post" action="filter.php" class="rounded shadow form p-5" id="form-validate" style="display: block;" >    
            <h2 class="text-center mb-5 text-grad">Search for destination</h2>

                <div class="row d-flex">
                    <div class="col-sm">
                        <label class="form-label">Budget</label>
                        <input type="number" class="form-fields" id="budget" name="budget" placeholder="Provide a budget">
                    </div>
                </div>


                <div class="mt-5 row d-flex">
                    <div class="col-sm justify-content-between mb-5">
                        <label class="form-label" name="season">Travel Season</label>
                        <select class="form-fields" id="gender" name="season">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Summer">Summer</option>
                            <option value="Winter">Winter</option>
                            <option value="Monsoon">Monsoon</option>
                        </select>
                    </div>
                
                </div>
                

                <div class="row d-flex">
                    <div class="col-sm justify-content-between mb-5">
                        <label class="form-label" name="traveler">Type of Travelers</label>
                        <select class="form-fields" id="gender" name="traveler">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Solo">Solo</option>
                            <option value="Couple">Couple</option>
                            <option value="Family">Family</option>
                            <option value="Group">Group</option>
                            <option value="Everyone">Everyone</option>
                        </select>
                    </div>
                  
                </div>
                
                <div class="row d-flex">
                    <div class="col-sm justify-content-between mb-5">
                        <label class="form-label">Category</label>
                        <select class="form-fields" name="category">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Beach">Beach</option>
                            <option value="Mountain">Mountain</option>
                            <option value="City">City</option>
                            <option value="Historical">Historical</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Relaxation">Relaxation</option>
                            <option value="Culture">Culture</option>
                            <option value="Nature">Nature</option>
                            <option value="Wildlife">Wildlife</option>
                            <option value="Luxury">Luxuary</option>
                            <option value="Spiritual">Spiritual</option>
                        </select>
                    </div>
                   
                </div>
                

                <div class="row d-flex">
                    <div class="col-sm-4 container d-flex btn-container mt-3">
                        <button type="submit" class="btn-grad mb-5 form-submit" id="form_submit" name="submit" onclick="formBlock()">Search</button>    
                    </div>
                </div>


            </form>

            <div id="resultTable" style="display: none;"></div>
        </div>
    </section>
    <script src="../assets/js/main.js"></script>
    <script>
        function formBlock(){
            document.getElementById('form_submit').style.display = none;
        }
    </script>
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>