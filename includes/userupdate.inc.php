<?php
//**************** error handlers to eto yung nagcheck muna kong may error bago irun yung code**********//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    
    try {

        require_once 'dbh.inc.php';
        
        // Retrieve user ID from session
        session_start();
        $user_id = $_SESSION["user_id"];

        // Prepare the query
        $query = "UPDATE users SET username = :username, email = :email WHERE id = :id;";

        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);  
        $stmt->bindParam(":id", $user_id); // Assuming you want to update the user with this ID

        // Execute the statement
        $stmt->execute();
        
        // Close the statement
        $stmt = null;
        
        // Redirect back to the dashboard
        header("Location: ../dashboard.html");
        exit(); 

    } catch (PDOException $e) {
        // Handle any exceptions
        die("Query failed: " . $e->getMessage());
    }

    // Close the database connection
    $pdo = null;
} else {
    // If not a POST request, redirect to index.php
    header("Location: ../index.html"); 
    exit();
}
?>
