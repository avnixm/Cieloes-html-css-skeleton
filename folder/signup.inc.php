<?php
//**************** Error Handlers **********************//

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];


    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        
        require_once 'signup_contr.inc.php';

//**************** error handlers to eto yung nagcheck muna kong may error bago irun yung code**********//
$errors = [];

if (is_input_empty($username,  $pwd, $email)) {
    $errors["empty_input"] = "Fill in all fields!";

}

if (is_email_invalid($email)) {
    $errors["invalid_email"] = "invalid email used!";
}

if (is_username_taken($pdo, $username)) {
    $errors["username_taken"] = "username already taken!";
}

if (is_email_registered($pdo, $email)) {
    $errors["email_used"] = "Email already registered!";
}

require_once 'config_session.inc.php';

if ($errors) {
    $_SESSION['erros_signup'] = $errors;

    $signupData = [
        "username" => $username,
        "email" => $email
    ];
    
    $_SESSION['signup_data'] = $signupData;

    header("Location: ../mainsignup.inc.php ");
    exit(); 

}

create_user( $pdo, $username, $pwd, $email);
header("Location: ../mainlogin.inc.php?signup=success");

$pdo = null;
$stmt = null;


    exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }


} else {
    header("Location: ../mainsignup.inc.php");
    exit();
}