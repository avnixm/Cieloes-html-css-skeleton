<?php
session_start();
include 'config.php';

$userId = $_SESSION['user_id']; // Assuming you have a logged-in user session
$cost = 350; // Cost of one refill

// Fetch user's gems and hearts
$query = "SELECT gems, hearts FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['gems'] >= $cost) {
    // Deduct gems and refill hearts
    $newGems = $user['gems'] - $cost;
    $newHearts = $user['hearts'] + 1; // or set to max hearts

    $updateQuery = "UPDATE users SET gems = ?, hearts = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("iii", $newGems, $newHearts, $userId);

    if ($updateStmt->execute()) {
        echo json_encode(["status" => "success", "gems" => $newGems, "hearts" => $newHearts]);
    } else {
        echo json_encode(["status" => "error", "message" => "Update failed"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Not enough gems"]);
}

$stmt->close();
$conn->close();
?>
