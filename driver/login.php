<?php
include 'users.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (isset($users[$user]) && $users[$user] === $pass) {
        header("Location: home.html");
        exit;
    } else {
        echo "Invalid login";
        exit;
    }
}
?>
