<?php
if (isset($_POST['logout'])) {
    session_start(); 
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
if (isset($_POST['no'])) {
    
    header("Location: myTrips.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Done Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- done -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,200" />
</head>
<style>
    i{
        color: green;
    }
</style>
<body style="height: 100vh; padding-top: 120px; padding-bottom: 165px;">
    <div class="rounded shadow container p-4 " style="width: 700px; ">
        <center>
        <i>
            <span class="material-symbols-outlined" style="font-size: 101px;">task_alt</span>
        </i> 
        <p class="display-5 mt-3">
            Are you sure that you want to logout?
        </p>
        <form action="logout.php" method="post">
        <a href=""><button class="btn btn-primary mt-3" name="logout">Yes, I confirm</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="myTrips.php"><button class="btn btn-primary mt-3" name="no">No, I stay here</button></a>
        </form>
        
        </center>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>