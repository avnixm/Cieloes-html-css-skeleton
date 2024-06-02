<?php
require __DIR__ . '/vendor/autoload.php'; // Include the Composer autoload file

use Auth0\SDK\Auth0;

$auth0Config = require_once 'auth0_config.php';
$auth0 = new Auth0($auth0Config);

// Check if the user is already logged in
$userInfo = $auth0->getUser();
if (!$userInfo) {
    // User is not logged in, redirect to Auth0 login page
    header('Location: ' . $auth0->login());
    exit();
}

// User is logged in, you can access user information from $userInfo
// Example: $userInfo['name'], $userInfo['email'],e tc.
?>
