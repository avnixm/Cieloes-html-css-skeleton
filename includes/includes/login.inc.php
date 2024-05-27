<?php
//**************** error handlers to eto yung nagcheck muna kong may error bago irun yung code**********//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = isset($_POST["password"]) ? $_POST["password"] : ''; // Check if the password field is set

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //**************** error handlers to eto yung nagcheck muna kong may error bago irun yung code**********//
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        elseif (is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION['errors_login'] = $errors;
            header("Location: ../mainlogin.inc.php ");
            exit(); 
        }
        
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../dashboard.html?login=success");
        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../dashboard.html");
    exit();
}

?>
