<?php

session_start();
require_once 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['firstname'];
            $_SESSION['username'] = $username;

            $conn->query("UPDATE users SET status='online' WHERE username='$username'");

            if ($user['role'] === 'user') {
                header("Location: /axis.com/home");
            } else {
                header("Location: /axis.com/admin/home");
            }
            exit();
        }
    }

    $_SESSION['username'] = $username;
    $_SESSION['login_error'] = 'INCORRECT USERNAME OR PASSWORD';
    header("Location: /axis.com/login");
    exit();
}

?>