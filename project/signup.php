<?php
$users = include 'users.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newUser = $_POST['newUserId'] ?? '';
    $pass = $_POST['newPassword'] ?? '';
    $confirm = $_POST['confirmPassword'] ?? '';

    if ($pass !== $confirm) {
        echo "Password mismatch";
        exit;
    }

    if (isset($users[$newUser])) {
        echo "User already exists";
        exit;
    }

    $users[$newUser] = $pass;
    $content = "<?php\nreturn " . var_export($users, true) . ";\n?>";
    file_put_contents("users.php", $content);

    header("Location: index.html");
    exit;
}
?>
