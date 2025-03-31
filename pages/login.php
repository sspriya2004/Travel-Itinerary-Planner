<?php
session_start();
include '../db.php'; // Ensure this file connects to the database

if (isset($_POST['login'])) {
    $mysqli = new mysqli("localhost", "root", "1544", "travel_itinerary_planner");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Fetch user_id along with password
    $stmt = $mysqli->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHash = $row['password'];

        if (password_verify($password, $storedHash)) {
            $_SESSION['user_id'] = $row['user_id'];  // Store user_id in session
            $_SESSION['username'] = $row['username'];
            $_SESSION['username'] = $username;

            header("Location: myTrips.php");
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- googleFonts -->
    <style>

@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Great+Vibes&family=Inter:wght@300;400;500;600&family=Josefin+Sans:ital,wght@0,300;0,500;1,700&family=Montserrat:wght@300;500&family=Nunito:wght@300&family=Prompt:wght@500&family=Roboto+Slab&display=swap');

*{
    font-family: 'Cinzel', serif;
font-family: 'Great Vibes', cursive;
font-family: 'Inter', sans-serif;
font-family: 'Josefin Sans', sans-serif;
font-family: 'Montserrat', sans-serif;
font-family: 'Nunito', sans-serif;
font-family: 'Prompt', sans-serif;
font-family: 'Roboto Slab', serif;

margin: 0;
padding: 0;
box-sizing: border-box;
}
.container{
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    column-gap: 30px;
}
.form{
    position: absolute;
    max-width: 430px;
    width: 100%;
    height: 80%;
    padding: 51px;
    padding-top:  50px;
    border-radius: 18px;
    border: 3px solid #E5E4E2;
    border-right: none ;
    
}

header{
    font-size: 27px;
    color: black;
    text-align: center;
}
.img-fluid{
    -webkit-box-shadow: 2px 2px 8px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 2px 8px 0px rgba(0,0,0,0.75);
box-shadow: 2px 2px 8px 0px rgba(0,0,0,0.75);
}
form{
    margin-bottom: 48px;
    margin-top: 86px;
}
#form{
    margin-top: 42px;
}
form .field{
    position: relative;
    height: 45px;
    width: 100%;
    margin-top: 17px;
}
.input-container{
    margin-top: 40px;
}
.field input
{
    outline: none;
    height: 100%;
    width: 100%;
    border: 1px solid #c0c0c0;
    border-top: none;
    border-right: none;
    border-left: none;
    padding: 0px 40px;
    font-size: 14px;
    transition-timing-function: ease;
    background-color: transparent;
}
.field:focus + .bx{
    color: #0171d3;
}

.field input:focus{
    border-bottom: 2px solid black;
}
.eye-icon{
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
    position: absolute;
    cursor: pointer;
    padding: 5px;
}
.icons{
    position: absolute;
    left: 17px;
    transform: translateX(-50%);
    top: 18%;
    padding: 5px;
    font-size: 22px;
    color: black;
}
.field button{
    height: 100%;
    width: 100%;
    border: none;
    font-size: 20px;
    border-radius: 6px;
    background-color: #0d47a1;
    color: #fff;
    transition: all 0.3s ease;
    cursor: pointer;
}
.field button:hover{
    background-color: #1976d2;
}
.err-icon{
    font-size: 15px;
  
}
hr{
    width: 34px;
    margin-left: 128px;
    border: 2px solid #c68e17;
    border-radius: 82px;
}
.form-link{
    text-align: center;
    margin-top: 21px;
    font-size: 15px;
}
.form a{
    color: darkslategray;
    text-decoration: none;
    font-size: 13px;
    margin-left: 218px;
}
#signup-clr{
    color: royalblue;
    font-size: 15px;
    margin-left: 2px;
}
.form a:hover{
    text-decoration: underline;
}
#carousel-container{
    width: 55%;
    height: 480px;
    background-color: transparent;
}
#images{
    width: 89%;
    height: 99%;
    margin-top: 5px;
    margin-left: 244px;
    border-radius: 18px;
}
.form.login,.form.signup {
    margin-right: 439px;
  }
  @media (max-width: 991.98px) {
    .form.login, .form.signup {
      margin-right: 0;
    }
    }
    </style>

</head>
<body>
  <section>
  <div class="container forms">
      <div class="form login" style="background: hwb(0 100% 0% / 0.55); backdrop-filter: blur(19px); height: 566px;">

              <header>Let's get started</header>
            
              <form action="login.php" method="post">
                  <div class="input-container">
                  <div class="field input-field">
                      <i class='bx bx-user icons'></i>
                      <input type="text" class="input" placeholder="Username" id="username" name="username" required>
                  </div>

                  <div class="field input-field">
                      <i class='bx bx-key icons'></i>
                      <input type="password" class="password" placeholder="Password" id="password" name="password" required>
                      <i class='bx bx-hide eye-icon'></i>
                  </div>
                  </div>

                  <div class="form-link">

                      <a href="#" class="forgot-pass" >Forgot password?</a>
                  </div>

                  <div>
                      <p style="color: red; text-align: center; margin-top: 16px; font-size: 13px; font-weight: 600;" id="login-message"></p>
                  </div>

                  <div class="field button-field">
                      <button type="submit" id="login-btn" name="login">Login</button>
                  </div>
              </form>
              
              <div class="form-link">
                  <span>Not a member? <a href="signup.php" class="link signup-link" id="signup-clr">Create an account</a> </span>                    
              </div>

      </div>

      <div class="col-sm-6 px-0 d-none d-sm-block rounded" id="carousel-container">
            <img src="../assets/images/road_asphalt_marking.jpg" class="img-fluid object-fit-cover rounded-end" id="images"/>
          </div>
      </div>
  </section>
  <script src="../assets/js/login.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</body>
</html>