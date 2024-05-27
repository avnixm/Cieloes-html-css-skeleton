<?php
session_start();
// Assuming you have a function to get the current user's ID
$user_id = $_SESSION['user_id'];

include 'config.php'; // Include your database connection file

// Function to deduct a heart
function deduct_heart($user_id) {
    global $conn;
    // Get the current number of hearts
    $query = "SELECT user_hearts FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hearts);
    $stmt->fetch();
    $stmt->close();

    if ($hearts > 0) {
        // Deduct one heart
        $hearts--;
        $query = "UPDATE users SET user_hearts = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $hearts, $user_id);
        if ($stmt->execute()) {
            $stmt->close();
            return array("status" => "success", "user_hearts" => $hearts);
        } else {
            $stmt->close();
            return array("status" => "error", "message" => "Failed to update hearts.");
        }
    } else {
        return array("status" => "error", "message" => "Not enough hearts.");
    }
}

// Deduct heart and return result
$result = deduct_heart($user_id);
echo json_encode($result);
?>
