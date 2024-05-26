<?php
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id !== null) {
    session_unset();
    session_destroy();

    header("Location: index.html");
    exit;
} else {
    header("Location: index.html");
    exit;
}
?>
