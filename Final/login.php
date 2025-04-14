<?php
session_start(); // Start the session to keep track of logged-in users

// Get the login info from the form, or use empty strings if something's missing
$userId = $_POST['userId'] ?? '';
$password = $_POST['password'] ?? '';

// Load the list of users from the file
$users = include 'users.php';

// Check if the user exists and if the password is correct
if (isset($users[$userId]) && password_verify($password, $users[$userId])) {
    // Login successful, save user ID in session and move to ride page
    $_SESSION['userId'] = $userId;
    header("Location: ride.html");
    exit();
} else {
    // Wrong username or password
    echo "Invalid login, try again 😶";
}
?>