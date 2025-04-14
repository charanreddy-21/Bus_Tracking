<?php
// Getting the list of already registered users
$users = include 'users.php';

// Check if the form was sent through POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Grab user input or use empty strings if something's missing
    $newUser = $_POST['newUserId'] ?? '';
    $pass = $_POST['newPassword'] ?? '';
    $confirm = $_POST['confirmPassword'] ?? '';

    // Make sure both password fields match
    if ($pass !== $confirm) {
        echo "Password is not corretc"; // keeping original spelling mistake
        exit;
    }

    // Check if this user ID is already taken
    if (isset($users[$newUser])) {
        echo "This User already exists, try new!";
        exit;
    }

    // Encrypt the password before saving it
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // Add new user to the list
    $users[$newUser] = $hashedPassword;

    // Rewrite the users.php file with the updated list
    $content = "<?php\nreturn " . var_export($users, true) . ";\n?>";
    file_put_contents("users.php", $content);

    // Go back to login page after signup
    header("Location: index.html");
    exit;
}
?>
