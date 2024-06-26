<?php

//********************** nag control sa lahat sa mga iba ibang function************/

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
    if (empty($username) || empty($pwd) || empty($email)){
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Email is invalid
    } else {
        return false; // Email is valid
    }
}

function is_username_taken(object $pdo, string $username) {
    if (get_username($pdo, $username)){
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) {
    if (get_email($pdo, $email)){
        return true;
    } else {
        return false;
    }
}
?>
