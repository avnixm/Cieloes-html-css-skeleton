<?php
//**************** error handlers to eto yung nagcheck muna kong may error bago irun yung code**********//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    
    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        
        require_once 'signup_contr.inc.php';

        // errors handlers

        $errors = [];

        if (pag_hindi_nagfillup($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";

        }

        if (pag_invalid_email($email)) {
            $errors["invalid_email"] = "invalid email used!";
        }

        if (pag_meron_na_parehongname($pdo, $username)) {
            $errors["username_taken"] = "username already taken!";
        }

        if (registered_ba_email($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION['erros_signup'] = $errors;

        }


       /* $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";

        $stmt = $pdo->prepare($query);

        $stmt->bindparam(":username", $username);
        $stmt->bindparam(":pwd", $pwd);
        $stmt->bindparam(":email", $email);  
        $stmt->execute();
        $stmt = null;
        */
        
        header("Location: ../dashboard.html");
        exit(); 

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

    $pdo = null;
} else {
    
    header("Location: ../index.php"); 
    exit();
}
