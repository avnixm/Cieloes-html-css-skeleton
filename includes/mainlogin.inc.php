<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/login_view.inc.php';
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Home</title>
</head>
<body>
    <header>
        <img src="images/wordwiselogo.png" class="logo-image">
        <a href="index.html" class="logo-text">CAIEL</a>
    </header>

    <!--***************************LOG in***************************-->
    <form action="includes/login.inc.php" method="post" id="login-form">
        <div class="signup-container">
            <div class="signup-details">
                <h2>Log In</h2>    
                <div class="close-btn" id="close-btn-login">&times;</div>
                <input type="text" id="s-username" name="username" placeholder="Email or Username">
                <input type="password" id="s-password" name="password" placeholder="Password">
                <div class="g-recaptcha" data-sitekey="6LcA170pAAAAAN3wE7LozfCHpFe48bbgdz24Y5po"></div>
                <button class="signup-btn" id="login-btn">Log in</button>
                <p>Already have an account? <a href="#" id="login-link">LOG IN</a></p>
            </div>
        </div>
    </form>

    <?php 
        check_login_errors();
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var closeButton = document.getElementById("close-btn-login");
            closeButton.addEventListener("click", function() {
                // Redirect to index.html
                window.location.href = "index.html";
            });
        });

        /* Captcha handling */
        document.addEventListener("DOMContentLoaded", function() {
            var loginForm = document.getElementById("login-form");

            loginForm.addEventListener("submit", function(event) {
                event.preventDefault(); 

                var captchaResponse = grecaptcha.getResponse(); 

                if (captchaResponse === "") {
                    alert("Please complete the CAPTCHA.");
                    return; 
                }

                // Proceed with form submission
                // You can add your login logic here...
                loginForm.submit(); // Submit the form after CAPTCHA verification
            });
        });
    </script>
</body>
</html>
