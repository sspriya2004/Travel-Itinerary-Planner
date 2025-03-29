<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/loginSignup.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- googleFonts -->
    

    
</head>
<body>
  <section>
  <div class="container forms">
      <div class="form login" style="background: hwb(0 100% 0% / 0.55); backdrop-filter: blur(19px); height: 566px;">
          <!-- <div class="form content"> -->
              <header>Let's get started</header>
            
              <form action="#">
                  <div class="input-container">
                  <div class="field input-field">
                      <i class='bx bx-user icons'></i>
                      <input type="text" class="input" placeholder="Username" id="username" required>
                  </div>

                  <div class="field input-field">
                      <i class='bx bx-key icons'></i>
                      <input type="password" class="password" placeholder="Password" id="password" required>
                      <i class='bx bx-hide eye-icon'></i>
                  </div>
                  </div>

                  <!-- <div class="form-link">
                      
                  </div> -->

                  <div class="form-link">
                      <!-- <div style="float: left;">
                          <input type="checkbox" class="checkbox" style="accent-color: #E49B0F;">
                          <label for="" style="font-size: 14px;"> Remember me </label>
                      </div> -->
                      <a href="#" class="forgot-pass" >Forgot password?</a>
                  </div>

                  <div>
                      <p style="color: red; text-align: center; margin-top: 16px; font-size: 13px; font-weight: 600;" id="login-message"></p>
                  </div>

                  <div class="field button-field">
                      <button type="submit" id="login-btn">Login</button>
                  </div>
              </form>
              
              <div class="form-link">
                  <span>Not a member? <a href="#" class="link signup-link" id="signup-clr">Create an account</a> </span>                    
              </div>
          <!-- </div> -->
      </div>

      <div class="form signup" style="background: hwb(0 100% 0% / 0.55); backdrop-filter: blur(19px); height: 566px;">
          <!-- <div class="form content"> -->
              <header>Create an account</header>
              
              <form action="#" id="form">
                  <div class="input-container">
                  <div class="field input-field">
                      <i class='bx bx-user icons'></i>
                      <input type="text" class="input" placeholder="Create a Username" id="username-new" required>
                  </div>

                  <div class="field input-field">
                      <i class='bx bx-envelope icons'></i>
                      <input type="email" class="input" placeholder="Enter your email" id="email">
                  </div>  

                  <div class="field input-field">
                      <i class='bx bx-key icons'></i>
                      <input type="password" class="password" placeholder="Create a new Password" id="password-new" required>
                      <i class='bx bx-hide eye-icon'></i>
                  </div>

                  <div class="field input-field">
                      <i class='bx bx-key icons'></i>
                      <input type="password" class="hidepassword" placeholder="Confirm new Password" id="password-confirm" required>
                      <!-- <i class='bx bx-hide eye-icon'></i> -->
                  </div>
                  </div>
                  
                  <div>
                      <p id="signup-message" style="color: red;text-align: center; margin-top: 16px; font-size: 13px;"></p>
                  </div>

                  <div class="field button-field">
                      <button type="submit" id="signup-btn"style="margin-top:19px" >Signup</button>
                  </div>
              </form>
              
              <div class="form-link">
                  <span>Already have an account? <a href="#" class="link login-link" id="signup-clr">Login</a> </span>                    
              </div>
          <!-- </div> -->
      </div>

      <div class="col-sm-6 px-0 d-none d-sm-block rounded" id="carousel-container">
            <img src="../assets/images/road_asphalt_marking.jpg" class="img-fluid object-fit-cover rounded-end" id="images"/>
          </div>
      </div>
  </section>
  <script src="../assets/js/loginSignup.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</body>
</html>