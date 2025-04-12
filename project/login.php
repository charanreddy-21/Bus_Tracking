<?php
session_start();

$userId = $_POST['userId'] ?? '';
$password = $_POST['password'] ?? '';

$users = include 'users.php';

if (isset($users[$userId]) && $users[$userId] === $password) {
    $_SESSION['userId'] = $userId;
    header("Location: ride.html");
    exit();
} else {
    echo "Invalid login";
}
?>
