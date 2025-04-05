<?php
include 'users.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newUser = $_POST['user'];
    $pass = $_POST['pass'];
    $confirm = $_POST['confirm'];

    if ($pass !== $confirm) {
        echo "Password mismatch";
        exit;
    }

    if (isset($users[$newUser])) {
        echo "User already exists";
        exit;
    }

    $users[$newUser] = $pass;
    $content = "<?php\n\$users = " . var_export($users, true) . ";\n?>";
    file_put_contents("users.php", $content);

    header("Location: home.html");
    exit;
}
?>
