<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Change this to your actual database password
$database = "cieloes";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve login data
$emailOrUsername = $_POST['username'];
$password = $_POST['password'];

// SQL query to retrieve user information
$sql = "SELECT user_id, user_email, user_name, user_password FROM userinfo WHERE user_email = '$emailOrUsername' OR user_name = '$emailOrUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['user_password'])) {
        // Password is correct, login successful
        echo json_encode(array('success' => true, 'user_id' => $row['user_id'], 'user_email' => $row['user_email'], 'user_name' => $row['user_name']));
    } else {
        // Password is incorrect
        echo json_encode(array('success' => false, 'message' => 'Incorrect password'));
    }
} else {
    // User not found
    echo json_encode(array('success' => false, 'message' => 'User not found'));
}

$conn->close();
?>
