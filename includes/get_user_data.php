<?php
session_start();
require 'dbh.inc.php'; // Adjust the path if needed


if (!isset($_SESSION["user_id"])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT username, email, user_exp, user_hearts FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // If the user is new, set default values
    if (is_null($user['user_exp']) || is_null($user['user_hearts'])) {
        $user['user_exp'] = 50;
        $user['user_hearts'] = 3;
    }
    echo json_encode(['status' => 'success', 'user' => $user]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}
?>
