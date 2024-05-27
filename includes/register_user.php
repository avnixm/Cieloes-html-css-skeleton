<?php
require 'dbh.inc.php'; // Adjust the path if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Set default values for new users
    $user_exp = 50;
    $user_hearts = 3;

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, user_exp, user_hearts) VALUES (:username, :email, :password, :user_exp, :user_hearts)");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'user_exp' => $user_exp,
        'user_hearts' => $user_hearts
    ]);

    echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
}
?>
