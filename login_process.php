<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Read user data from the users.txt file
    $userData = file_get_contents('users/users.txt');
    $userData = explode("\n", $userData);

    foreach ($userData as $user) {
        list($savedUsername, $savedHashedPassword) = explode(':', $user);
        if ($username === $savedUsername && password_verify($password, $savedHashedPassword)) {
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect to the main page after successful login
            exit();
        }
    }

    $_SESSION['error'] = "Invalid username or password";
    header("Location: login.php"); // Redirect back to the login page with an error message
    exit();
}
?>
