<?php
session_start();
include 'config.php';

$userId = $_SESSION['user_id']; // Assuming you have a logged-in user session

// Fetch user's gems and hearts
$query = "SELECT gems, hearts FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    echo json_encode(["status" => "success", "gems" => $user['gems'], "hearts" => $user['hearts']]);
} else {
    echo json_encode(["status" => "error", "message" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
