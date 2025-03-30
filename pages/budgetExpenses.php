<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Fees Entry Form</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/myTrips.css">
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
            
            <div class="menu-container">
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
            <div class="menu-container  menu-active">
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
        <div class="container py-5 mt-0">
            <form method="post" class=" rounded shadow form p-5" id="form-validate">
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