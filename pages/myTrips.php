<?php
session_start();
include "../db.php"; // Include your database connection file

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view your trips.");
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Fees Entry Form</title>
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
    <?php echo '<center style="margin-top:36px;"><span style="color: #4B70F5; font-weight: 600; font-size: 25px;">Logged in as ' . $username . '</span></center>'; ?>
    <div class="container py-5 mt-0">
            <!-- <form method="post" class=" rounded shadow form p-5" id="form-validate">
                <h2 class="text-center mb-5 text-grad">Staff Profile Entry Form</h2>
                <div class="row d-flex">
                    <div class="col mb-5">
                        <input type="hidden" id="username" value="">
                        <label class="form-label">Staff Name</label>
                        <input type="text" class="form-fields" id="staff_name" placeholder="Ex: Lekha.R" required>
                        <div class="invalid-feedback">Please enter the name</div>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label">Gender</label>
                        <select class="form-fields" id="gender" required>
                            <option value="" selected disabled hidden>Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <div class="invalid-feedback">Please select the gender</div>
                    </div>
                    <div class="col-sm-6 justify-content-between mb-5">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" class="form-fields" placeholder="Enter Date of Birth" id="date_of_birth" required> 
                        <div class="invalid-feedback">Please enter the date of birth</div>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="mb-5 col-sm-6 justify-content-between">
                        <label class="form-label">Whatsapp Number</label>
                        <input type="number" class="form-fields" placeholder="Enter the Number" id="whatsapp_number" required> 
                        <div class="invalid-feedback">Please enter the whatsapp number</div>
                    </div>
                    <div class="mb-5 col-sm-6 justify-content-between">
                        <label class="form-label">Alternative Number</label>
                        <input type="number" class="form-fields" placeholder="Enter Alternative Number" id="alternative_number" required> 
                        <div class="invalid-feedback">Please enter the alternative number</div>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="mb-5 col">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-fields" placeholder="Enter Address" id="address" required> 
                        <div class="invalid-feedback">Please enter the address</div>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="mb-5 col-sm-4 justify-content-between">
                        <label class="form-label">City</label>
                        <input type="text" class="form-fields" placeholder="Enter City" id="city" required> 
                        <div class="invalid-feedback">Please enter the city</div>
                    </div>
                    <div class="mb-5 col-sm-4 justify-content-between">
                        <label class="form-label">State</label>
                        <input type="text" class="form-fields" placeholder="Enter State" id="state" required> 
                        <div class="invalid-feedback">Please enter the state</div>
                    </div>
                    <div class="mb-5 col-sm-4 justify-content-between">
                        <label class="form-label">Pincode</label>
                        <input type="number" class="form-fields" placeholder="Enter the Pincode" id="pincode" required> 
                        <div class="invalid-feedback">Please enter the pincode</div>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="mb-5 col-sm-6 justify-content-between">
                        <label class="form-label">Date of Joining</label>
                        <input type="date" class="form-fields" id="joining_date" required>
                        <div class="invalid-feedback">Please enter the joining date</div>
                    </div>
                </div>
                <div class="container d-flex btn-container mt-3">
                    <button type="submit" class="btn-grad mb-5 form-submit" id="formSubmit">Submit</button>    
                </div>
            </form> -->
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
                            <a href='edit_trip.php?id={$row['trip_id']}' class='btn-delete btn btn-primary' style='width: 110px;'>Edit</a> &nbsp
                            <a href='delete_trip.php?id={$row['trip_id']}' class='btn-delete btn btn-danger' style='width: 110px;' onclick='return confirm(\"Are you sure?\")'>Delete</a> &nbsp 
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