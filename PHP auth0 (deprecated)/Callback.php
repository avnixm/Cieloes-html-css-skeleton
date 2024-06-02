<?php
require __DIR__ . '/vendor/autoload.php';

use Auth0\SDK\Auth0;

$auth0Config = require_once 'auth0_config.php';
$auth0 = new Auth0($auth0Config);


$auth0->process();

// If authentication was successful, retrieve user information
$userInfo = $auth0->getUser();

if ($userInfo) {
    // Successful authentication, user information is available
    // Example: Store user information in session and redirect to dashboard
    session_start();
    $_SESSION['user'] = $userInfo;
    header('Location: .php');
    exit();
} else {
    // Authentication failed or invalid callback
    // Example: Redirect to login page with error message
    header('Location: login.php?error=auth_failed');
    exit();
}
