
 <?php 
        require_once 'includes/config_session.inc.php';
        require_once 'includes/signup_view.inc.php';
        
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="x-icon" href="images/foxlogo.png">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../modal.js"></script>
    <title>Home</title>
</head>

<body>
<header>
        <img src="images/wordwiselogo.png" class="logo-image">
        <a href="index.html" class="logo-text">CAIEL</a>
    </header>

        

     <!--***************************SIGN UP***************************-->
        <form action="includes/signup.inc.php" method="post" id="signupform">
     
            <div class="signup-container">
            
                 <div class="signup-details">
            
                       <h2>Sign Up</h2>
                     <div class="close-btn" id="signup-close-btn" >&times;</div>
                        <?php
                        
                        signup_inputs();

                        ?>
                        
                         <button class="signup-btn" id="signup-btn">SIGN UP</button>
                          <p>Already have an account? <a href="#" id="login-link">Log In</a></p>
        </form>    
        
        <?php
           
            clear_signup_session_data();
    
            check_signup_errors();
        ?>
            
                 </div>
        </div>



    

   
        <script>
      
      document.addEventListener("DOMContentLoaded", function() {
          var signupButton = document.getElementById("signup-close-btn"); 
          signupButton.addEventListener("click", function() {
              window.location.href = "index.html";

          });
      });

     



document.addEventListener("DOMContentLoaded", function() {
    var signupButton = document.getElementById("signup-close-btn");
    signupButton.addEventListener("click", function() {
        // Clear signup inputs
        document.getElementById("s-username").value = "";
        document.getElementById("s-password").value = "";
        document.getElementById("s-email").value = "";
        // Redirect to index.html
        window.location.href = "index.html";
       
    });
});




    



  </script>
   
     <script src="../modal.js"></script>
  
</body>
</html>
   