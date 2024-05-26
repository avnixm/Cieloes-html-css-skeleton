<?php

declare(strict_types=1);

function signup_inputs() {
   
    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) 
    {

        echo '<input type="text" id="s-username" name="username" placeholder="Username" 
        value="' . $_SESSION["signup_data"]["username"] . '">';
    } else {
        echo '<input type="text" id="s-username" name="username" placeholder="Username">';
    }

    echo ' <input type="password" id="s-password" name="pwd" placeholder="Password">';

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) 
    && !isset($_SESSION["errors_signup"]["invalid_email"])) 
    {

        echo '<input type="text" id="s-email" name="email" placeholder="Email"
         value="' . $_SESSION["signup_data"]["email"] . '">';
    } else {
        echo '<input type="text" id="s-email" name="email" placeholder="Email">';
    }
}

function clear_signup_session_data() {
    unset($_SESSION["signup_data"]);
    unset($_SESSION["errors_signup"]);
}



function check_signup_errors() {
    if (isset($_SESSION['erros_signup'])) {
        $errors = $_SESSION['erros_signup'];
        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['erros_signup']);

    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class"form-success">Signup success!</p>';
    }
}
