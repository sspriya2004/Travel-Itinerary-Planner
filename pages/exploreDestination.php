<?php
include "../db.php";
session_start();
$user_id = $_SESSION['user_id']; // Get logged-in user ID
$username = $_SESSION['username'];
if (isset($_POST['form_submit'])) {

// Get user input from POST
$budget = $_POST['budget'];
$season = $_POST['season'];
$traveler = $_POST['traveler'];
$category = $_POST['category'];

// Prepare SQL query
$sql = "SELECT * 
FROM destinations
WHERE average_cost <= ?
ORDER BY average_cost Desc;

";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $budget);
$stmt->execute();

$result = $stmt->get_result();

// Display Results
if ($result->num_rows > 0) {
    echo "<script>document.getElementById('form-validate').style.display = 'none';</script>";
    echo "<style>
        table, th, td {
            border: 3px solid white;
            padding:20px;

        }
        #table{
            margin-left: 39px;
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

    </style>
    <section class='main-content' id='main-content'>
    <table border='1' style='margin-top: 20px;' id='table'>
            <tr>
              <th>Name</th>
              <th>Location</th>
              <th>Cost</th>
              <th>Season</th>
              <th>Category</th>
              <th>Rating</th>
              <th>Action</th>
            </tr>
          ";
            

while ($row = $result->fetch_assoc()) {
    echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['average_cost']}</td>
                <td>{$row['best_season']}</td>
                <td>{$row['category']}</td>
                <td>{$row['rating']}</td>
                <td>
                  <form method='POST' action='myTrips.php' class='rounded shadow form p-5' id='form-validate'>
                    <input type='hidden' name='destination_id' value='{$row['destination_id']}'>
                    <input type='hidden' name='name' value='{$row['name']}'>
                    <input type='hidden' name='location' value='{$row['location']}'>
                    <input type='hidden' name='average_cost' value='{$row['average_cost']}'>
                    <button type='submit'>Add to Your Trips</button>
                  </form>
                </td>
              </tr>";
}
echo "</table>  </section>";
    
} else {
    echo "<script>alert('No destinations match your preferences.')</script>";
}
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
    <?php echo '<center style="margin-top:36px;"><span style="color: #4B70F5; font-weight: 600; font-size: 25px;">Logged in as ' . $username . '</span></center>'; ?>
        <div class="container py-5 mt-0">
            <form method="post" action="exploreDestination.php" class=" rounded shadow form p-5" id="form-validate">
                <h2 class="text-center mb-5 text-grad">Search for Destinations</h2>
                <div class="row d-flex">
                    <div class="col mb-5">
                        <label class="form-label">Budget</label>
                        <input type="number" class="form-fields" id="budget" name="budget" placeholder="Provide a budget" required>
                    </div>
                </div>

                <div class="row d-flex">
                <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label" name="season">Travel Season</label>
                        <select class="form-fields" id="gender" name="season" required>
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Summer">Summer</option>
                            <option value="Winter">Winter</option>
                            <option value="Monsoon">Monsoon</option>

                        </select>
                        <div class="invalid-feedback">Please select the gender</div>
                    </div>
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label" name="traveler">Type of Travelers</label>
                        <select class="form-fields" id="gender" name="traveler" required>
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Solo">Solo</option>
                            <option value="Couple">Couple</option>
                            <option value="Family">Family</option>
                            <option value="Group">Group</option>
                            <option value="Everyone">Everyone</option>
                        </select>
                        <div class="invalid-feedback">Please select the gender</div>
                    </div>
                </div>
                
                <div class="row d-flex">
                <div class="col-sm-12 justify-content-between mb-5">
                        <label class="form-label">Category</label>
                        <select class="form-fields" id="gender" name="category" required>
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
                        <div class="invalid-feedback">Please select the gender</div>
                    </div>
                </div>
                
                <div class="container d-flex btn-container mt-3">
                    <button type="submit" class="btn-grad mb-5 form-submit" id="formSubmit" name="form_submit">Submit</button>    
                </div>
            </form>
            <div id="resultTable" style="display: none;"></div>
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